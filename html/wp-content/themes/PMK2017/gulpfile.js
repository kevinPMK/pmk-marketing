var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');
var inject = require('gulp-inject');

var rename = require('gulp-rename');
var svgstore = require('gulp-svgstore');
var svgmin = require('gulp-svgmin');
var path = require('path');

gulp.task('images', () =>
  gulp.src('src/images/*')
    .pipe(imagemin())
    .pipe(gulp.dest('src/m_images'))
);

gulp.task('styles',function() {
  // Compiles CSS
  return gulp.src('src/scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(gulp.dest('./src/'))
});

gulp.task('svgstore', function () {
    return gulp
        .src('src/app-icons/*.svg')
        .pipe(rename({prefix: 'svg-icon-'}))
        .pipe(svgmin(function (file) {
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: 'svg-icon-',
                        minify: true
                    }
                }]
            }
        }))
        .pipe(svgstore({ inlineSvg: true }))
        .pipe(gulp.dest('src'));
});


gulp.task('default', ['styles', 'images', 'svgstore'], function() {
  gulp.watch('src/scss/**/*', ['styles']);
  gulp.watch('src/images/**/*', ['images']);
  gulp.watch('src/app-icons/*', ['svgstore']);
});
