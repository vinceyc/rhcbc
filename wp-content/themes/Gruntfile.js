module.exports = function(grunt) {

  grunt.initConfig({

    // Watches for changes and runs tasks
    // Livereload is setup for the 35729 port by default
    watch: {
      compass: {
        files: ['**/*.scss'],
        tasks: ['compass'],
        options: {
          livereload: 35729
        }
      },
      php: {
        files: ['**/*.php'],
        options: {
          livereload: 35729
        }
      }
    },

    // Sass object
    compass: {
      dist: {
        options: {
          sassDir: 'rhcbc/sass',
          cssDir: 'rhcbc'
        }
      }
    },

  });


  // Load up tasks
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task
  grunt.registerTask('default', ['watch']);

};