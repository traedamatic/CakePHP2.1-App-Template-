module.exports = (grunt)->

  #Project configuration.
  grunt.initConfig
    pkg: grunt.file.readJSON('package.json')

    cssmin:
      compile:
        files:
          'web/css/compiled.css' : 'dist/css/style.css'  

    # stylus
    stylus:
      compile:
        files:
          'webroot/css/style.css': 'webroot/css/style.styl'          
      dev:
        options:
          compress: false
        files:
          'webroot/css/style.css': 'webroot/css/style.styl'
    # compile coffee
    coffee:
      compile:
        files:
          'webroot/js/main.js' : 'webroot/js/*.coffee'
          # 'webroot/js/views.js' : 'Assets/javascripts/Views/*.coffee'
        options :
          bare : true
      dev:
        files:
          'webroot/js/main.js' : 'webroot/js/*.coffee'
        options :
          bare : true
 
    # watch task
    watch:
      scripts:
        files: ['webroot/js/*.coffee']
        tasks: ['coffee:dev']
      styles:
        files: ['webroot/css/*.styl']
        tasks: ['stylus:dev']

    # parallel tasks
    parallel:
      watch:[
          grunt: true
          args: ['watch:scripts']
      ,
          grunt: true
          args: ['watch:styles']
      ]
    

  #Load the plugin tasks.
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-stylus')
  grunt.loadNpmTasks('grunt-contrib-coffee')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-parallel')
  grunt.loadNpmTasks('grunt-contrib-cssmin')
  grunt.loadNpmTasks('grunt-shell')


  #Default task(s).
  grunt.registerTask('default', ['stylus:dev','coffee:dev'])
  grunt.registerTask('compile', ['stylus:compile','coffee:compile',"shell:compile"])
  # grunt.registerTask('deploy', ['compile','ftp-deploy:build'])'uglify:compile','cssmin:compile'

