'use strict';

module.exports = function (grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    concat: {
      options: {
        seperator: ';'
      },
      js_frontend: {
        src: [
          './app/assets/vendor/angular/angular.js',
          './app/assets/vendor/angular-bootstrap/ui-bootstrap.js',
          './app/assets/vendor/bootstrap/dist/bootstrap.js',
          './app/assets/vendor/modernizr/modernizr.js',
          './app/assets/vendor/requirejs/require.js',
          './app/assets/scripts/frontend/*.js'
        ],
        dest: './public/assets/scripts/frontend/core.js'
      },
      js_frontend_home: {
        src: [
          './app/assets/scripts/frontend/*.js'
        ],
        dest: './public/assets/scripts/frontend/home/*.js'
      },
      js_backend: {
        src: [
          './app/assets/vendor/angular/angular.js',
          './app/assets/vendor/angular-bootstrap/ui-bootstrap.js',
          './app/assets/vendor/modernizr/modernizr.js',
          './app/assets/vendor/requirejs/require.js',
          './app/assets/scripts/backend/*.js'
        ],
        dest: './public/assets/scripts/backend/core.js'
      }
    },
    less: {
      options: {
        imports: {
          reference: [
            "variables.less", "mixins.less", "buttons.less", "forms.less", "utilities.less"
          ]
        },
        compress: true
      },
      components: {
        files: [
          {
            expand: true,
            cwd: './app/assets/vendor/font-awesome/less',
            src: ['*.less', '!{var,mix}*.less'],
            dest: './public/assets/styles/font-awesome',
            ext: '.css'
          },
          {
            expand: true,
            cwd: './app/assets/vendor/bootstrap/less',
            src: ['*.less', '!{boot,var,mix}*.less'],
            dest: './public/assets/styles/bootstrap',
            ext: '.css'
          }
        ]
      },
      styles: {
        files: {
          './public/assets/styles/frontend/bootstrap.css':
          [
            './public/assets/styles/bootstrap/forms.css',
            './public/assets/styles/bootstrap/grid.css',
            './public/assets/styles/bootstrap/navbar.css',
            './public/assets/styles/bootstrap/navs.css',
            './public/assets/styles/bootstrap/media.css',
            './public/assets/styles/bootstrap/print.css',
            './public/assets/styles/bootstrap/type.css',
            './public/assets/styles/bootstrap/normalize.css',
            './public/assets/styles/bootstrap/utilities.css',
            './public/assets/styles/bootstrap/scaffolding.css',
            './public/assets/styles/bootstrap/glyphicons.css',
            './public/assets/styles/bootstrap/input-groups.css',
            './public/assets/styles/bootstrap/wells.css',
            './public/assets/styles/bootstrap/responsive-utilities.css',
          ],
          './public/assets/styles/frontend/core.css':
          [
            './app/assets/styles/frontend/*.less'
          ],
          './public/assets/styles/frontend/font-awesome.css':
          [
            './public/assets/styles/font-awesome/font-awesome.css'
          ],
          './public/assets/styles/backend/core.css':
          [
            './app/assets/styles/backend/*.less',
            './public/assets/styles/bootstrap/forms.css',
            './public/assets/styles/bootstrap/grid.css',
            './public/assets/styles/bootstrap/navs.css',
            './public/assets/styles/bootstrap/navbar.css',
            './public/assets/styles/bootstrap/print.css',
            './public/assets/styles/bootstrap/theme.css',
            './public/assets/styles/bootstrap/responsive-utilities.css',
            './public/assets/styles/font-awesome/*.css'
          ]
        }
      }
    },
    uglify: {
      options: {
        mangle: false
      },
      frontend: {
        files: {
          './public/assets/scripts/frontend/core.js': ['./public/assets/scripts/frontend/core.js']
        }
      },
      backend: {
        files: {
          './public/assets/scripts/backend/core.js': ['./public/assets/scripts/backend/core.js']
        }
      }
    },
    phpunit: {
      classes: {
      },
      options: {
      }
    },
    watch: {
      js_frontend: {
        files: [
          './app/assets/scripts/frontend/*.js'
        ],
        tasks: ['concat:js_frontend', 'uglify:frontend'],
        options: {
          livereload: true
        }
      },
      js_backend: {
        files: [
          './app/assets/scripts/backend/*.js'
        ],
        tasks: ['concat:js_backend', 'uglify:backend'],
        options: {
          livereload: true
        }
      },
      less: {
        files: ['./app/assets/styles/frontend/*.less', './app/assets/styles/backend/*.less'],  //watched files
        tasks: ['less'],                          //tasks to run
        options: {
          livereload: true                        //reloads the browser
        }
      },
      tests: {
        files: ['./app/controllers/*.php','./app/models/*.php'],  //the task will run only when you save files in this location
        tasks: ['phpunit']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('assemble-less');
//  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-phpunit');

  // Task definition
  grunt.registerTask('default', ['watch']);
};