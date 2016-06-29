'use strict';
module.exports = function (grunt) {
    // Load grunt tasks automatically
    require('load-grunt-tasks')(grunt);

    // Project configuration.
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        copy: {
            main: {
                files: [
                    // includes admin lte plugins
                    //{
                    //    expand: true,
                    //    cwd: 'node_components/admin-lte/plugins/',
                    //    src: ['**/*'],
                    //    dest: 'public/assets/theme/plugins/'
                    //},

                    // includes admin-lte dist folder
                    {   expand: true,
                        cwd: 'node_modules/admin-lte/dist/',
                        src: ['**/*'],
                        dest: 'public/assets/theme/dist/'
                    },

                    // Copy bootstrap fonts
                    {   expand: true,
                        cwd: 'node_modules/bootstrap/dist/',
                        src: ['**/*'],
                        dest: 'public/assets/bootstrap/'
                    },

                 // Copy bootstrap images
                    {   expand: true,
                        cwd: 'node_modules/ionicons/',
                        src: ['**/*'],
                        dest: 'public/assets/ionicons/'
                    },

                    // Copy font-awesome fonts
                    {   expand: true,
                        cwd: 'node_modules/font-awesome/',
                        src: ['**/*'],
                        dest: 'public/assets/font-awesome/'
                    },
										//
                    //Bootstrap-datepicker
                    {   expand: true,
                        cwd: 'node_modules/bootstrap-datepicker/dist/css',
                        src: ['**/*'],
                        dest: 'public/assets/bootstrap-datepicker/'
                    },

                ]
            }
        }



    });


    // Default task(s).
    grunt.registerTask('default', ['copy']);

};