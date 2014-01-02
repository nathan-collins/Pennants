/* jshint node: true */

module.exports = function (grunt) {
  'use strict';

  // Force use of Unix newlines
  grunt.util.linefeed = '\n';

  RegExp.quote = function (string) {
    return string.replace(/[-\\^$*+?.()|[\]{}]/g, '\\$&')
  }

  var fs = require('fs')
  var btoa = require('btoa')

  // Project configuration.
  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*!\n' +
              ' * Bootstrap v<%= pkg.version %> (<%= pkg.homepage %>)\n' +
              ' * Copyright <%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
              ' * Licensed under <%= _.pluck(pkg.licenses, "type") %> (<%= _.pluck(pkg.licenses, "url") %>)\n' +
              ' */\n',
    jqueryCheck: 'if (typeof jQuery === "undefined") { throw new Error("Bootstrap requires jQuery") }\n\n',

    // Task configuration.
    clean: {
      dist: ['dist']
    },

    jshint: {
      options: {
        jshintrc: 'js/.jshintrc'
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      src: {
        src: ['js/*.js']
      },
      test: {
        src: ['js/tests/unit/*.js']
      },
      assets: {
        src: ['docs-assets/js/application.js', 'docs-assets/js/customizer.js']
      }
    },

    jscs: {
      options: {
        config: 'js/.jscs.json',
      },
      gruntfile: {
        src: ['Gruntfile.js']
      },
      src: {
        src: ['js/*.js']
      },
      test: {
        src: ['js/tests/unit/*.js']
      }
    },

    csslint: {
      options: {
        csslintrc: '.csslintrc'
      },
      src: [
        'dist/css/bootstrap.css',
        'dist/css/bootstrap-theme.css',
        'docs-assets/css/docs.css'
      ]
    },

    concat: {
      options: {
        banner: '<%= banner %>\n<%= jqueryCheck %>',
        stripBanners: false
      },
      bootstrap: {
        src: [
          'js/transition.js',
          'js/alert.js',
          'js/button.js',
          'js/carousel.js',
          'js/collapse.js',
          'js/dropdown.js',
          'js/modal.js',
          'js/tooltip.js',
          'js/popover.js',
          'js/scrollspy.js',
          'js/tab.js',
          'js/affix.js'
        ],
        dest: 'dist/js/<%= pkg.name %>.js'
      }
    },

    uglify: {
      bootstrap: {
        options: {
          banner: '<%= banner %>\n',
          report: 'min'
        },
        src: ['<%= concat.bootstrap.dest %>'],
        dest: 'dist/js/<%= pkg.name %>.min.js'
      },
      customize: {
        options: {
          banner: '/*!\n' +
          ' * Bootstrap Docs (<%= pkg.homepage %>)\n' +
          ' * Copyright <%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
          ' * Licensed under the Creative Commons Attribution 3.0 Unported License. For\n' +
          ' * details, see http://creativecommons.org/licenses/by/3.0/.\n' +
          ' */\n',
          report: 'min'
        },
        src: [
          'docs-assets/js/less.js',
          'docs-assets/js/jszip.js',
          'docs-assets/js/uglify.js',
          'docs-assets/js/filesaver.js',
          'docs-assets/js/customizer.js'
        ],
        dest: 'docs-assets/js/customize.js'
      }
    },

    less: {
      compileCore: {
        options: {
          strictMath: true,
          sourceMap: true,
          outputSourceFiles: true,
          sourceMapURL: '<%= pkg.name %>.css.map',
          sourceMapFilename: 'dist/css/<%= pkg.name %>.css.map'
        },
        files: {
          'dist/css/<%= pkg.name %>.css': 'less/bootstrap.less'
        }
      },
      compileTheme: {
        options: {
          strictMath: true,
          sourceMap: true,
          outputSourceFiles: true,
          sourceMapURL: '<%= pkg.name %>-theme.css.map',
          sourceMapFilename: 'dist/css/<%= pkg.name %>-theme.css.map'
        },
        files: {
          'dist/css/<%= pkg.name %>-theme.css': 'less/theme.less'
        }
      },
      minify: {
        options: {
          cleancss: true,
          report: 'min'
        },
        files: {
          'dist/css/<%= pkg.name %>.min.css': 'dist/css/<%= pkg.name %>.css',
          'dist/css/<%= pkg.name %>-theme.min.css': 'dist/css/<%= pkg.name %>-theme.css'
        }
      }
    },

    usebanner: {
      dist: {
        options: {
          position: 'top',
          banner: '<%= banner %>'
        },
        files: {
          src: [
            'dist/css/<%= pkg.name %>.css',
            'dist/css/<%= pkg.name %>.min.css',
            'dist/css/<%= pkg.name %>-theme.css',
            'dist/css/<%= pkg.name %>-theme.min.css',
          ]
        }
      }
    },

    csscomb: {
      sort: {
        options: {
          sortOrder: '.csscomb.json'
        },
        files: {
          'dist/css/<%= pkg.name %>.css': ['dist/css/<%= pkg.name %>.css'],
          'dist/css/<%= pkg.name %>-theme.css': ['dist/css/<%= pkg.name %>-theme.css'],
        }
      }
    },

    copy: {
      fonts: {
        expand: true,
        src: ['fonts/*'],
        dest: 'dist/'
      }
    },

    qunit: {
      options: {
        inject: 'js/tests/unit/phantom.js'
      },
      files: ['js/tests/*.html']
    },

    connect: {
      server: {
        options: {
          port: 3000,
          base: '.'
        }
      }
    },

    jekyll: {
      docs: {}
    },

    jade: {
      compile: {
        options: {
          pretty: true,
          data: function (dest, src) {
            /*
            Mini-language:
              //== This is a normal heading, which starts a section. Sections group variables together.
              //## Optional description for the heading

              //** Optional description for the following variable. You **can** use Markdown in descriptions to discuss `<html>` stuff.
              @foo: #ffff;

              //-- This is a heading for a section whose variables shouldn't be customizable

              All other lines are ignored completely.
            */
            var path = require('path');
            var fs = require('fs');
            var markdown = require('markdown').markdown;

            var filePath = path.join(__dirname, 'less/variables.less');
            var lines = fs.readFileSync(filePath, {encoding: 'utf8'}).split('\n');

            function Section(heading, customizable) {
              this.heading = heading.trim();
              this.id = this.heading.replace(/\s+/g, '-').toLowerCase();
              this.customizable = customizable;
              this.docstring = null;
              this.variables = [];
              this.addVar = function (variable) {
                this.variables.push(variable);
              };
            }
            function markdown2html(markdownString) {
              // the slice removes the <p>...</p> wrapper output by Markdown processor
              return markdown.toHTML(markdownString.trim()).slice(3, -4);
            }
            function VarDocstring(markdownString) {
              this.html = markdown2html(markdownString);
            }
            function SectionDocstring(markdownString) {
              this.html = markdown2html(markdownString);
            }
            function Variable(name, defaultValue) {
              this.name = name;
              this.defaultValue = defaultValue;
              this.docstring = null;
            }
            function Tokenizer() {
              this.CUSTOMIZABLE_HEADING = /^[/]{2}={2}(.*)$/;
              this.UNCUSTOMIZABLE_HEADING = /^[/]{2}-{2}(.*)$/;
              this.SECTION_DOCSTRING = /^[/]{2}#{2}(.*)$/;
              this.VAR_ASSIGNMENT = /^(@[a-zA-Z0-9_-]+):[ ]*([^ ;][^;]+);[ ]*$/;
              this.VAR_DOCSTRING = /^[/]{2}[*]{2}(.*)$/;

              this._next = undefined;
            }
            Tokenizer.prototype.unshift = function (token) {
              if (this._next !== undefined) {
                throw new Error('Attempted to unshift twice!');
              }
              this._next = token;
            };
            Tokenizer.prototype._shift = function () {
              // returning null signals EOF
              // returning undefined means the line was ignored
              if (this._next !== undefined) {
                var result = this._next;
                this._next = undefined;
                return result;
              }
              if (lines.length <= 0) {
                return null;
              }
              var line = lines.shift();
              var match = null;
              match = this.CUSTOMIZABLE_HEADING.exec(line);
              if (match !== null) {
                return new Section(match[1], true);
              }
              match = this.UNCUSTOMIZABLE_HEADING.exec(line);
              if (match !== null) {
                return new Section(match[1], false);
              }
              match = this.SECTION_DOCSTRING.exec(line);
              if (match !== null) {
                return new SectionDocstring(match[1]);
              }
              match = this.VAR_DOCSTRING.exec(line);
              if (match !== null) {
                return new VarDocstring(match[1]);
              }
              var commentStart = line.lastIndexOf('//');
              var varLine = (commentStart === -1) ? line : line.slice(0, commentStart);
              match = this.VAR_ASSIGNMENT.exec(varLine);
              if (match !== null) {
                return new Variable(match[1], match[2]);
              }
              return undefined;
            };
            Tokenizer.prototype.shift = function () {
              while (true) {
                var result = this._shift();
                if (result === undefined) {
                  continue;
                }
                return result;
              }
            };
            var tokenizer = new Tokenizer();
            function Parser() {}
            Parser.prototype.parseFile = function () {
              var sections = [];
              while (true) {
                var section = this.parseSection();
                if (section === null) {
                  if (tokenizer.shift() !== null) {
                    throw new Error('Unexpected unparsed section of file remains!');
                  }
                  return sections;
                }
                sections.push(section);
              }
            };
            Parser.prototype.parseSection = function () {
              var section = tokenizer.shift();
              if (section === null) {
                return null;
              }
              if (!(section instanceof Section)) {
                throw new Error('Expected section heading; got: ' + JSON.stringify(section));
              }
              var docstring = tokenizer.shift();
              if (docstring instanceof SectionDocstring) {
                section.docstring = docstring;
              }
              else {
                tokenizer.unshift(docstring);
              }
              this.parseVars(section);
              return section;
            };
            Parser.prototype.parseVars = function (section) {
              while (true) {
                var variable = this.parseVar();
                if (variable === null) {
                  return;
                }
                section.addVar(variable);
              }
            };
            Parser.prototype.parseVar = function () {
              var docstring = tokenizer.shift();
              if (!(docstring instanceof VarDocstring)) {
                tokenizer.unshift(docstring);
                docstring = null;
              }
              var variable = tokenizer.shift();
              if (variable instanceof Variable) {
                variable.docstring = docstring;
                return variable;
              }
              tokenizer.unshift(variable);
              return null;
            };

            return {sections: (new Parser()).parseFile()};
          }
        },
        files: {
          '_includes/customizer-variables.html': 'customizer-variables.jade'
        }
      }
    },

    validation: {
      options: {
        charset: 'utf-8',
        doctype: 'HTML5',
        failHard: true,
        reset: true,
        relaxerror: [
          'Bad value X-UA-Compatible for attribute http-equiv on element meta.',
          'Element img is missing required attribute src.'
        ]
      },
      files: {
        src: ['_gh_pages/**/*.html']
      }
    },

    watch: {
      src: {
        files: '<%= jshint.src.src %>',
        tasks: ['jshint:src', 'qunit']
      },
      test: {
        files: '<%= jshint.test.src %>',
        tasks: ['jshint:test', 'qunit']
      },
      less: {
        files: 'less/*.less',
        tasks: ['less']
      }
    },

    sed: {
      versionNumber: {
        pattern: (function () {
          var old = grunt.option('oldver')
          return old ? RegExp.quote(old) : old
        })(),
        replacement: grunt.option('newver'),
        recursive: true
      }
    },

    'saucelabs-qunit': {
      all: {
        options: {
          build: process.env.TRAVIS_JOB_ID,
          concurrency: 3,
          urls: ['http://127.0.0.1:3000/js/tests/index.html'],
          browsers: grunt.file.readYAML('test-infra/sauce_browsers.yml')
        }
      }
    }
  });


  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

  // Docs HTML validation task
  grunt.registerTask('validate-html', ['jekyll', 'validation']);

  // Test task.
  var testSubtasks = [];
  // Skip core tests if running a different subset of the test suite
  if (!process.env.TWBS_TEST || process.env.TWBS_TEST === 'core') {
    testSubtasks = testSubtasks.concat(['dist-css', 'jshint', 'jscs', 'qunit', 'build-customizer-vars-form']);
  }
  // Skip HTML validation if running a different subset of the test suite
  if (!process.env.TWBS_TEST || process.env.TWBS_TEST === 'validate-html') {
    testSubtasks.push('validate-html');
  }
  // Only run Sauce Labs tests if there's a Sauce access key
  if (typeof process.env.SAUCE_ACCESS_KEY !== 'undefined'
      // Skip Sauce if running a different subset of the test suite
      && (!process.env.TWBS_TEST || process.env.TWBS_TEST === 'sauce-js-unit')) {
    testSubtasks.push('connect');
    testSubtasks.push('saucelabs-qunit');
  }
  grunt.registerTask('test', testSubtasks);

  // JS distribution task.
  grunt.registerTask('dist-js', ['concat', 'uglify']);

  // CSS distribution task.
  grunt.registerTask('dist-css', ['less', 'csscomb', 'usebanner']);

  // Fonts distribution task.
  grunt.registerTask('dist-fonts', ['copy']);

  // Full distribution task.
  grunt.registerTask('dist', ['clean', 'dist-css', 'dist-fonts', 'dist-js']);

  // Default task.
  grunt.registerTask('default', ['test', 'dist', 'build-glyphicons-data', 'build-customizer']);

  // Version numbering task.
  // grunt change-version-number --oldver=A.B.C --newver=X.Y.Z
  // This can be overzealous, so its changes should always be manually reviewed!
  grunt.registerTask('change-version-number', ['sed']);

  grunt.registerTask('build-glyphicons-data', function () {
    // Pass encoding, utf8, so `readFileSync` will return a string instead of a
    // buffer
    var glyphiconsFile = fs.readFileSync('less/glyphicons.less', 'utf8')
    var glpyhiconsLines = glyphiconsFile.split('\n')

    // Use any line that starts with ".glyphicon-" and capture the class name
    var iconClassName = /^\.(glyphicon-[^\s]+)/
    var glyphiconsData = '# This file is generated via Grunt task. **Do not edit directly.** \n' +
                         '# See the \'build-glyphicons-data\' task in Gruntfile.js.\n\n';
    for (var i = 0, len = glpyhiconsLines.length; i < len; i++) {
      var match = glpyhiconsLines[i].match(iconClassName)

      if (match != null) {
        glyphiconsData += '- ' + match[1] + '\n'
      }
    }

    // Create the `_data` directory if it doesn't already exist
    if (!fs.existsSync('_data')) fs.mkdirSync('_data')

    fs.writeFileSync('_data/glyphicons.yml', glyphiconsData)
  });

  // task for building customizer
  grunt.registerTask('build-customizer', ['build-customizer-vars-form', 'build-raw-files']);
  grunt.registerTask('build-customizer-vars-form', ['jade']);
  grunt.registerTask('build-raw-files', 'Add scripts/less files to customizer.', function () {
    function getFiles(type) {
      var files = {}
      fs.readdirSync(type)
        .filter(function (path) {
          return type == 'fonts' ? true : new RegExp('\\.' + type + '$').test(path)
        })
        .forEach(function (path) {
          var fullPath = type + '/' + path
          return files[path] = (type == 'fonts' ? btoa(fs.readFileSync(fullPath)) : fs.readFileSync(fullPath, 'utf8'))
        })
      return 'var __' + type + ' = ' + JSON.stringify(files) + '\n'
    }

    var files = getFiles('js') + getFiles('less') + getFiles('fonts')
    fs.writeFileSync('docs-assets/js/raw-files.js', files)
  });
};
