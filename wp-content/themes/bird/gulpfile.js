var gulp = require('gulp');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var uglify = require('gulp-uglify');
var browserSync = require ('browser-sync').create();
var reload = browserSync.reload;

//var for path
var styleSRC = 'library/scss/style.scss'; //Path for source file
var styleDist = './dist/css/'; //path for dist for converted files
var styleWatch = 'library/scss/**/*.scss';

var jsSRC = 'global.js'; //Path for source file
var jsFolder = 'library/global/';  //js folder
var jsDist = './dist/js/'; //path for dist for converted files
var jsWatch = 'library/global/**/global.js';
var jsFILES = [jsSRC];  //array use

gulp.task( 'browser-sync', function() {
  browserSync.init({
    // server: {
    //   baseDir: "./"
    // }
    proxy: "design-by-ishwor.loc/localsite/",
		//notify: false
  });
});


//create a task for scss and css
gulp.task('style', function(){
  gulp.src( styleSRC )
    .pipe( sourcemaps.init() ) //map the source file **2
    .pipe( sass({
    errorLogToConsole: true, //Convert sass to css and display the error message **1
    outputStyle: 'compressed' //compressed sass files
    }) )
    .on( 'error', console.error.bind( console ) ) //**1
    .pipe( autoprefixer ({
    browsers: ['last 2 versions'],   //automatic fullful the browser specific code like -web- , -o-, -ms- etc
    cascade:false
    }))
    .pipe( rename ( { suffix: '.min' } ) ) //convert css file and rename it with .min example: stylesheet.min.css
    .pipe( sourcemaps.write( './' )) //write the source sourcemaps file **2
    .pipe( gulp.dest ( styleDist ) )
    .pipe( browserSync.stream() );
});

//create a task for javascript
gulp.task('js', function(){
  jsFILES.map(function( entry ){
    return browserify({
      entries: [jsFolder + entry]
    })
    .transform( babelify, { presets: [ 'env' ] } )
    .bundle()
    .pipe( source( entry ) )
    .pipe( rename({ extname: '.min.js' }) )
    .pipe( buffer() )
    .pipe( sourcemaps.init( { loadMaps: true } ))
    .pipe( uglify() )
    .pipe( sourcemaps.write( './' ) )
    .pipe( gulp.dest( jsDist ) )
    .pipe( browserSync.stream() );
  });

});

//Default task
gulp.task('default', ['style', 'js']);

//gulp watch to make it automatic compile
gulp.task( 'watch', [ 'default', 'browser-sync' ], function(){
  gulp.watch( styleWatch, [ 'style', reload ] ); //keep watch by calling this function and also check any file is added in src folder
  gulp.watch( jsWatch, ['js', reload ] ); //same things for js
});
