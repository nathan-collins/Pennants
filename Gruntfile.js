'use strict';

module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        clean: {
            dist: {
                files: [{
                    dot: true,
                    src: [
                        'public/assets/styles/*',
                        'public/assets/scripts/*'
                    ]
                }]
            }
        },
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'assets/scripts/{,*/}*.js',
                '!assets/vendor/*',
                'assets/test/spec/{,*/}*.js'
            ]
        },
        modernizr: {
            devFile: 'assets/vendor/modernizr/modernizr.js',
            outputFile: 'public/assets/vendor/modernizr/modernizr.js',
            files: [
                'public/assets/scripts/{,*/}*.js',
                'public/assets/styles/{,*/}*.css',
                '!public/assets/vendor/*'
            ],
            uglify: true
        },
        autoprefixer: {
            options: {
                browsers: [ 'last 1 version' ]
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: 'assets/styles/',
                    src: '{,*/}*.css',
                    dest: 'public/assets/styles/'
                }]
            }
        },
        php: {
            options: {
                router: 'server.php',
                hostname: 'localhost',
                port: 9999
            },
            test: {
                options: {
                    keepalive: true,
                    open: true
                }
            },
            watch: {}
        },
        copy: {
            dist: {
                expand: true,
                dot: true,
                cwd: 'assets',
                src: [
                    'styles/{,*/}*.css',
                    'scripts/{,*/}*.js',
                    'images/{,*/}*.*',
                    'vendor/requirejs/require.js'
                ],
                dest: 'public/assets'
            }
        },
        cssmin: {
            minify: {
                expand: true,
                cwd: 'public/assets/styles/',
                src: ['*.css', '!*.min.css'],
                dest: 'public/assets/styles/',
                ext: '.min.css'
            }
        }
    });

  grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('server', [
        'jshint',
        'build',
        'php:watch',
        'watch'
    ]);

    grunt.registerTask('build', [
        'clean:dist',
        'autoprefixer',
        'modernizr',
        'copy:dist'
    ]);

    grunt.registerTask('default', [
        'jshint',
        'build',
        'less',
        'cssmin'
    ]);
};