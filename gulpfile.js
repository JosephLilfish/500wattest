// Gulpfile.js running on stratumui,
// a css framework available on npmjs.com
var gulp 	= require('gulp'),
  	sass 	= require('gulp-sass'),
  	concat 	= require('gulp-concat'),
  	// uglify 	= require('gulp-uglify'),
  	rename 	= require('gulp-rename');

var paths = {
  styles: {
		src: ['css/sass/partials/*',
			  'css/sass/modules/*',
			  'css/sass/partials/header/*',
			  'css/sass/partials/home/*',
			  'css/sass/partials/footer/*', 
			  'css/sass/partials/posts/*',
			  'css/sass/partials/woo/*',
			  'css/sass/partials/pages/*'] ,
    dest: 'xxx/'
  },
  scripts: {
    src: 'js/*.js',
    dest: '.'
  }
};

function styles() {
  return gulp
  	.src('css/sass/style.scss')
    // .pipe(concat(paths.styles.src))
	.pipe(sass())
	// .pipe(rename({
	//   basename: 'styless'
	// }))
.pipe(gulp.dest( '.' ));
}

function scripts() {
  return gulp
	.src(paths.scripts.src, {
		sourcemaps: true
	})
	// .pipe(uglify())
	.pipe(concat('main.min.js'))
	.pipe(gulp.dest(paths.scripts.dest));
}

function watch() {
  gulp
	  .watch(paths.scripts.src, scripts);
  gulp
  	.watch(paths.styles.src, styles);
}

var build = gulp.parallel(styles, scripts, watch);

gulp
  .task(build);
gulp
  .task('default', build);
