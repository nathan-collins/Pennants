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
        coffee: {
            options: {
                bare: true
            },
            dist: {
                options: {
                    sourceMap: false
                },
                files: [{
                    expand: true,
                    cwd: 'assets/scripts',
                    src: '{,*/}*.coffee',
                    dest: 'public/assets/scripts',
                    ext: '.js'
                }]
            },
            test: {
                files: [{
                    expand: true,
                    cwd: 'assets/test/spec',
                    src: '{,*/}*.coffee',
                    dest: 'public/assets/test/spec',
                    ext: '.js'
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
        compass: {
            options: {
                sassDir: 'assets/styles',
                cssDir: 'public/assets/styles',
                generatedImagesDir: 'public/assets/images/out',
                imagesDir: 'public/assets/images',
                javascriptsDir: 'public/assets/scripts',
                fontsDir: 'public/assets/styles/fonts',
                importPath: 'assets/vendor',
                httpImagesPath: '/assets/images',
                httpGeneratedImagesPath: '/assets/images/out',
                httpFontsPath: '/assets/styles/fonts',
                relativeAssets: false,
                assetCacheBuster: false
            },
            dist: {
                options: {
                    outputStyle: 'compressed',
                    noLineComments: true
                }
            },
            server: {
                options: {
                    debugInfo: true
                }
            }
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
        watch: {
            coffee: {
                files: [ 'assets/scripts/{,*/}*.coffee' ],
                tasks: [ 'coffee:dist' ]
            },
            coffeeTest: {
                files: [ 'assets/test/spec/{,*/}*.coffee' ],
                tasks: [ 'coffee:test' ]
            },
            compass: {
                files: [ 'assets/styles/{,*/}*.{scss,sass}' ],
                tasks: [ 'compass:server', 'autoprefixer' ]
            },
            styles: {
                files: [ 'assets/styles/{,*/}*.css' ],
                tasks: [ 'copy:dist', 'autoprefixer' ]
            },
            scripts: {
                files: [ 'assets/scripts/{,*/}*.js' ],
                tasks: [ 'jshint', 'copy:dist' ]
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    'app/views/{,*/}*.php',
                    'public/assets/{,*/}*.*'
                ]
            }
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
        }
    });

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
        'compass',
        'copy:dist'
    ]);

    grunt.registerTask('default', [
        'jshint',
        'build'
    ]);
};