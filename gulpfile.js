var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');

//post css
var postcss      = require('gulp-postcss');
var precss       = require('precss');
var cssnext      = require('postcss-cssnext');
var cssimport    = require('postcss-import');
var customMedia  = require('postcss-custom-media');
var minmax       = require('postcss-media-minmax');
var cssnesting   = require('postcss-nesting');
var simpleExtend = require('postcss-extend');
var webpack      = require('webpack-stream');
var shell        = require('gulp-shell');
var rename       = require('gulp-rename');
var less         = require('gulp-less-sourcemap');
var named        = require('vinyl-named');
var gutil        = require('gulp-util');

// karma/jasmine/phantomjs
var karmaServer = require('karma').Server;

gulp.task('unit-test', function(done){
    new karmaServer({
        configFile: __dirname + '/karma.conf.js'
    }, done).start();
});


/***********************************************/

gulp.task('css', function () {
    var processors = [
        cssimport(),
        cssnext({
            'browsers':          ['last 2 version'],
            'customProperties':  true,
            'colorFunction':     true,
            'customSelectors':   true,
            'sourcemap':         true,
            'nesting':           true,
            'compress':          false
        }),
        cssimport,
        customMedia,
        minmax,
        cssnesting,
        simpleExtend,
        precss
    ];

    return gulp.src('./src/css/styles.css')
        .pipe(postcss(processors))
        .pipe(gulp.dest('./dist/'));
});

gulp.task('js', function() {
    return gulp.src('./src/js/app.js')
        .pipe(named())
        .pipe(webpack( require('./webpack.config.js') ))
        .pipe(gulp.dest('./dist/'))

});


/* When calling gulp dev, call css and js */
gulp.task('dev', ['css','js']);

gulp.task('watch-css', function() {
    gulp.watch('src/css/*.css', ['css']);
});

gulp.task('watch-js', function() {
    gulp.watch('src/js/*.js', ['js']);
});
