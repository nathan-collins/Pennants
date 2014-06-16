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
          './public/vendor/jquery/dist/jquery.js',
          './public/vendor/angular/angular.js',
          './public/vendor/angular-sanitize/angular-sanitize.js',
          './public/vendor/angular-resource/angular-resource.js',
          './public/vendor/angular-cookies/angular-cookies.js',
          './public/vendor/underscore/underscore.js',
          './public/vendor/modernizr/modernizr.js',
          './public/vendor/angular-bootstrap/ui-bootstrap-tpls.js'
        ],
        dest: './public/assets/scripts/frontend/core.js'
      },
      js_backend: {
        src: [
          './public/vendor/jquery/dist/jquery.js',
          './public/vendor/angular/angular.js',
          './public/vendor/angular-sanitize/angular-sanitize.js',
          './public/vendor/angular-resource/angular-resource.js',
          './public/vendor/angular-cookies/angular-cookies.js',
          './public/vendor/underscore/underscore.js',
          './public/vendor/modernizr/modernizr.js',
          './public/vendor/angular-bootstrap/ui-bootstrap-tpls.js'
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
            cwd: './public/vendor/font-awesome/less',
            src: ['*.less', '!{var,mix}*.less'],
            dest: './public/assets/lib/font-awesome',
            ext: '.css'
          },
          {
            expand: true,
            cwd: './public/vendor/bootstrap/less',
            src: ['*.less', '!{boot,var,mix}*.less'],
            dest: './public/assets/lib/bootstrap',
            ext: '.css'
          }
        ]
      },
      styles: {
        files: {
          './public/assets/styles/frontend/bootstrap.css':
          [
            './public/assets/lib/bootstrap/forms.css',
            './public/assets/lib/bootstrap/grid.css',
            './public/assets/lib/bootstrap/dropdown.css',
            './public/assets/lib/bootstrap/navs.css',
            './public/assets/lib/bootstrap/navbar.css',
            './public/assets/lib/bootstrap/media.css',
            './public/assets/lib/bootstrap/print.css',
            './public/assets/lib/bootstrap/type.css',
            './public/assets/lib/bootstrap/normalize.css',
            './public/assets/lib/bootstrap/utilities.css',
            './public/assets/lib/bootstrap/scaffolding.css',
            './public/assets/lib/bootstrap/glyphicons.css',
            './public/assets/lib/bootstrap/input-groups.css',
            './public/assets/lib/bootstrap/wells.css',
            './public/assets/lib/bootstrap/buttons.css',
            './public/assets/lib/bootstrap/responsive-utilities.css',
          ],
          './public/assets/styles/frontend/blog/blog.css':
          [
            './public/styles/less/blog/blog.less'
          ],
          './public/assets/styles/frontend/core.css':
          [
            './public/styles/less/core/frontend/core.less'
          ],
          './public/assets/styles/frontend/pennants/pennants.css':
          [
            './public/styles/less/pennants/pennants.less'
          ],

          './public/assets/styles/backend/core.css':
          [
            './public/styles/less/core/backend/core.less'
          ],
          './public/assets/styles/backend/login/login.css':
          [
            './public/styles/less/login/login.less'
          ],
          './public/assets/styles/backend/season/season.css':
          [
            './public/styles/less/season/season.less'
          ],
          './public/assets/styles/backend/player/player.css':
          [
            './public/styles/less/player/player.less'
          ],
          './public/assets/styles/backend/grade/grade.css':
          [
            './public/styles/less/grade/grade.less'
          ],
          './public/assets/styles/backend/draws/draws.css':
          [
            './public/styles/less/draws/draws.less'
          ],

          './public/assets/styles/backend/match/match.css':
          [
            './public/styles/less/match/match.less'
          ],

          './public/assets/styles/backend/results/results.css':
            [
              './public/styles/less/results/results.less'
            ],


          './public/assets/styles/backend/font-awesome.css':
          [
            './public/assets/lib/font-awesome/core.css',
            './public/assets/lib/font-awesome/font-awesome.css',
            './public/assets/lib/font-awesome/icons.css',
            './public/assets/lib/font-awesome/list.css',
            './public/assets/lib/font-awesome/path.css',
            './public/assets/lib/font-awesome/bordered-pull.css'
          ],
          './public/assets/styles/backend/bootstrap.css':
          [
            './public/assets/lib/bootstrap/alerts.css',
            './public/assets/lib/bootstrap/badges.css',
            './public/assets/lib/bootstrap/breadcrumbs.css',
            './public/assets/lib/bootstrap/close.css',
            './public/assets/lib/bootstrap/forms.css',
            './public/assets/lib/bootstrap/labels.css',
            './public/assets/lib/bootstrap/grid.css',
            './public/assets/lib/bootstrap/navs.css',
            './public/assets/lib/bootstrap/navbar.css',
            './public/assets/lib/bootstrap/print.css',
            './public/assets/lib/bootstrap/type.css',
            './public/assets/lib/bootstrap/normalize.css',
            './public/assets/lib/bootstrap/utilities.css',
            './public/assets/lib/bootstrap/scaffolding.css',
            './public/assets/lib/bootstrap/glyphicons.css',
            './public/assets/lib/bootstrap/media.css',
            './public/assets/lib/bootstrap/normalize.css',
            './public/assets/lib/bootstrap/input-groups.css',
            './public/assets/lib/bootstrap/wells.css',
            './public/assets/lib/bootstrap/list-group.css',
            './public/assets/lib/bootstrap/panels.css',
            './public/assets/lib/bootstrap/tables.css',
            './public/assets/lib/bootstrap/buttons.css',
            './public/assets/lib/bootstrap/jumbotron.css',
            './public/assets/lib/bootstrap/dropdowns.css',
            './public/assets/lib/bootstrap/responsive-utilities.css',
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
          './public/assets/scripts/frontend/min/core.js': ['./public/assets/scripts/frontend/core.js']
        }
      },
      backend: {
        files: {
          './public/assets/scripts/backend/min/core.js': ['./public/assets/scripts/backend/core.js']
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
      less: {
        files: ['./public/styles/less/**/*.less'],  //watched files
        tasks: ['less'],                          //tasks to run
        options: {
          livereload: true                        //reloads the browser
        }
      }
//      tests: {
//        files: ['./app/controllers/*.php','./app/models/*.php'],  //the task will run only when you save files in this location
//        tasks: ['phpunit']
//      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('assemble-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
//  grunt.loadNpmTasks('grunt-phpunit');

  // Task definition
  grunt.registerTask('default', ['watch']);
};