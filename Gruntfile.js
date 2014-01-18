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
          './public/vendor/angular/angular.js',
          './public/vendor/angular-sanitize/angular-sanitize.js',
          './public/vendor/bootstrap/dist/bootstrap.js',
          './public/vendor/angular-bootstrap/ui-bootstrap.js',
          './public/vendor/underscore/underscore.js',
          './public/vendor/modernizr/modernizr.js',
          './public/vendor/requirejs/require.js',
        ],
        dest: './public/assets/scripts/frontend/global/core.js'
      },
      js_backend: {
        src: [
          './public/vendor/angular/angular.js',
          './public/vendor/angular-route/angular-route.js',
          './public/vendor/angular-sanitize/angular-sanitize.js',
          './public/vendor/bootstrap/dist/bootstrap.js',
          './public/vendor/angular-bootstrap/ui-bootstrap.js',
          './public/vendor/underscore/underscore.js',
          './public/vendor/modernizr/modernizr.js',
          './public/vendor/requirejs/require.js',
          './public/scripts/backend/core.js',
          './public/scripts/backend/auth.js',
          './public/scripts/backend/sidebar.js'
        ],
        dest: './public/assets/scripts/backend/global/core.js'
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
            cwd: './public/vendor/font-awesome/less',
            src: ['*.less', '!{var,mix}*.less'],
            dest: './public/libs/font-awesome',
            ext: '.css'
          },
          {
            expand: true,
            cwd: './public/vendor/bootstrap/less',
            src: ['*.less', '!{boot,var,mix}*.less'],
            dest: './public/libs/bootstrap',
            ext: '.css'
          }
        ]
      },
      styles: {
        files: {
          './public/assets/styles/frontend/bootstrap.css':
          [
            './public/libs/bootstrap/forms.css',
            './public/libs/bootstrap/grid.css',
            './public/libs/bootstrap/navbar.css',
            './public/libs/bootstrap/navs.css',
            './public/libs/bootstrap/media.css',
            './public/libs/bootstrap/print.css',
            './public/libs/bootstrap/type.css',
            './public/libs/bootstrap/normalize.css',
            './public/libs/bootstrap/utilities.css',
            './public/libs/bootstrap/scaffolding.css',
            './public/libs/bootstrap/glyphicons.css',
            './public/libs/bootstrap/input-groups.css',
            './public/libs/bootstrap/wells.css',
            './public/libs/bootstrap/buttons.css',
            './public/libs/bootstrap/responsive-utilities.css',
          ],
          './public/assets/styles/frontend/core.css':
          [
            './public/frontend/global/styles/less/*.less'
          ],



          './public/assets/styles/backend/core.css':
            [
              './public/backend/global/styles/less/*.less'
            ],
          './public/assets/styles/backend/font-awesome.css':
          [
            './public/libs/font-awesome/core.css',
            './public/libs/font-awesome/font-awesome.css',
            './public/libs/font-awesome/icons.css',
            './public/libs/font-awesome/list.css',
            './public/libs/font-awesome/path.css',
            './public/libs/font-awesome/bordered-pull.css'
          ],
          './public/assets/styles/backend/bootstrap.css':
          [
            './public/libs/bootstrap/forms.css',
            './public/libs/bootstrap/labels.css',
            './public/libs/bootstrap/grid.css',
            './public/libs/bootstrap/navs.css',
            './public/libs/bootstrap/navbar.css',
            './public/libs/bootstrap/print.css',
            './public/libs/bootstrap/type.css',
            './public/libs/bootstrap/normalize.css',
            './public/libs/bootstrap/utilities.css',
            './public/libs/bootstrap/scaffolding.css',
            './public/libs/bootstrap/glyphicons.css',
            './public/libs/bootstrap/input-groups.css',
            './public/libs/bootstrap/wells.css',
            './public/libs/bootstrap/list-group.css',
            './public/libs/bootstrap/panels.css',
            './public/libs/bootstrap/tables.css',
            './public/libs/bootstrap/buttons.css',
            './public/libs/bootstrap/responsive-utilities.css',
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
          './public/assets/scripts/frontend/global/core.js': ['./public/frontend/global/scripts/core.js']
        }
      },
      backend: {
        files: {
          './public/assets/scripts/backend/global/core.js': ['./public/backend/global/scripts/core.js']
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
          './public/frontend/global/scripts/*.js'
        ],
        tasks: ['concat:js_frontend', 'uglify:frontend'],
        options: {
          livereload: true
        }
      },
      js_backend: {
        files: [
          './public/backend/global/scripts/*.js'
        ],
        tasks: ['concat:js_backend', 'uglify:backend'],
        options: {
          livereload: true
        }
      },
      js_backend_admin: {
        files: [
          './public/backend/**/*.js'
        ],
        tasks: ['uglify:backend'],
        options: {
          livereload: true
        }
      },
      less: {
        files: ['./public/frontend/global/styles/less/*.less', './public/backend/global/styles/less/*.less'],  //watched files
        tasks: ['less'],                          //tasks to run
        options: {
          livereload: true                        //reloads the browser
        }
      },
      tests: {
        files: ['./public/controllers/*.php','./app/models/*.php'],  //the task will run only when you save files in this location
        tasks: ['phpunit']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('assemble-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-phpunit');

  // Task definition
  grunt.registerTask('default', ['watch']);
};