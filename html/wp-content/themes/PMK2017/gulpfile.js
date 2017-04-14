var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');
var inject = require('gulp-inject');

var rename = require('gulp-rename');
var svgstore = require('gulp-svgstore');
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

gulp.task('svgstore', function(){

  var svgs = gulp.src('src/svg/**/*.svg', { base: 'src/svg' })
    .pipe(rename({prefix: 'svg-icon-'}))
    .pipe(svgstore({ inlineSvg: true }));

    function fileContents (filePath, file) {
        return file.contents.toString();
    }

    //console.log(svgs);

  gulp.src('./header.php')
    .pipe(inject(svgs, {
      starttag: '<!-- inject:svg -->',
      transform: function (filePath, file) {
        return file.contents.toString('utf8')
      }
    }))
    .pipe(gulp.dest('./'));
});


gulp.task('default', ['styles', 'images', 'svgstore'], function() {
  gulp.watch('src/scss/**/*', ['styles']);
  gulp.watch('src/images/**/*', ['images']);
  gulp.watch('src/svg/**/*', ['svgstore']);
});
