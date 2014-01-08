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
              './app/assets/vendor/bootstrap/dist/js/bootstrap.js',
              './app/assets/vendor/angular/angular.js',
              './app/assets/vendor/modernizr/modernizr.js',
              './app/assets/vendor/requirejs/require.js',
              './app/assets/scripts/frontend.js'
            ],
            dest: './public/assets/scripts/frontend.js'
          },
          js_backend: {
            src: [
              './app/assets/vendor/bootstrap/dist/js/bootstrap.js',
              './app/assets/vendor/angular/angular.js',
              './app/assets/vendor/modernizr/modernizr.js',
              './app/assets/vendor/requirejs/require.js',
              './app/assets/scripts/backend.js'
            ],
            dest: './public/assets/scripts/backend.js'
          }
        },
        less: {
          development: {
            options: {
              compress: true
            },
            files: {
              "./public/assets/styles/frontend.css":"./app/assets/styles/frontend.less",
              "./public/assets/styles/backend.css":"./app/assets/styles/backend.less"
            }
          }
        },
        uglify: {
          options: {
            mangle: false
          },
          frontend: {
            files: {
              './public/assets/scripts/frontend.js': ['./app/assets/scripts/frontend.js']
            }
          },
          backend: {
            files: {
              './public/assets/scripts/backend.js': ['./app/assets/scripts/backend.js']
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
              './app/assets/vendor/bootstrap/dist/js/bootstrap.js',
              './app/assets/scripts/frontend.js'
            ],
            tasks: ['concat:js_frontend', 'uglify:frontend'],
            options: {
              livereload: true
            }
          },
          js_backend: {
            files: [
              './app/assets/vendor/bootstrap/dist/js/bootstrap.js',
              './app/assets/scripts/backend.js'
            ],
            tasks: ['concat:js_backend', 'uglify:backend'],
            options: {
              livereload: true
            }
          },
          less: {
            files: ['./app/assets/styles/*.less'],  //watched files
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
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-phpunit');

  // Task definition
  grunt.registerTask('default', ['watch']);
};