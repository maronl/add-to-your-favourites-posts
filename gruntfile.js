module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> (<%= pkg.version %>) - <%= grunt.template.today("yyyy-mm-dd") %> */\n',
                compress: { drop_console: true }
            },
            public: {
                src: 'public/js/atyfp-public.js',
                dest: 'public/js/prod/atyfp-public.<%= pkg.version %>.min.js'
            }
        },
        watch: {
            scripts: {
                files: ['admin/js/*.js','public/js/*.js'],
                tasks: ['uglify'],
            },
                php: {
              files: ['*.php', '**/*.php']
            },
            options: {
                livereload: true,
                spawn: false
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('default', ['uglify', 'watch']);
};