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
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
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

gulp.task('app-svg-sfx', function () {
    return gulp
        .src('src/app-sfx/*.svg')
        .pipe(rename({prefix: 'svg-sfx-'}))
        .pipe(svgmin(function (file) {
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: 'svg-sfx-',
                        minify: true
                    }
                }]
            }
        }))
        .pipe(svgstore({ inlineSvg: true }))
        .pipe(gulp.dest('src'));
});


gulp.task('default', ['styles', 'images', 'svgstore', 'app-svg-sfx'], function() {
  gulp.watch('src/scss/**/*', ['styles']);
  gulp.watch('src/images/**/*', ['images']);
  gulp.watch('src/app-icons/*', ['svgstore']);
  gulp.watch('src/app-sfx/*', ['app-svg-sfx']);
});
