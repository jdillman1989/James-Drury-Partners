'use strict';

var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var imagemin = require('gulp-imagemin');

gulp.task('default', function () {
  gulp.src('./scripts/*.js')
  .pipe(uglify())
  .pipe(gulp.dest('./wp-content/themes/jadle/assets/js'));

  gulp.src('./styles/application.scss')
  .pipe(sass().on('error', sass.logError))
  .pipe(gulp.dest('./wp-content/themes/jadle/assets/css'));

  gulp.src('./images/*')
  .pipe(imagemin())
  .pipe(gulp.dest('./wp-content/themes/jadle/assets/img'))
});