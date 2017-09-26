'use strict';

const gulp = require('gulp');
const del = require('del');

 //html
var pug = require('gulp-pug'),
	runSequence = require('run-sequence'),
	htmlhint = require("gulp-htmlhint"),

	//css
	sass = require('gulp-sass'),
	sassLint = require('gulp-sass-lint'),
	csso = require('gulp-csso'),
	concat = require('gulp-concat'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemaps = require('gulp-sourcemaps'),

	//js
    babel = require('gulp-babel'),
	uglify = require('gulp-uglify'),

	//img
	imagemin = require('gulp-imagemin'),

	//watch
	watch = require('gulp-watch'),

	//other
	zip = require('gulp-zip'),
	notify = require("gulp-notify"),
	browserSync = require('browser-sync'),
	rename = require("gulp-rename"),
	cache = require('gulp-cache');


// path
var path = {
	dev: {
		html: ['dev/**/*.pug','!dev/blocks/**/*.pug', '!dev/tpl/**/*.pug'],
		css: 'dev/css/main.sass',
		js: 'dev/js/script.js',
		fonts: 'dev/fonts/**/*.*',
		img: 'dev/images/**/**/**/*.*'
	},
	dist: {
		html: 'dist/',
		htmlmin: 'dist/_min',
		css: 'dist/assets/css',
		cssmin: 'dist/_min/assets/css',
		js: 'dist/assets/js',
		jsmin: 'dist/_min/assets/js',
		img: 'dist/assets/images',
		fonts: 'dist/assets/fonts',
	},
	watch: {
		html: 'dev/**/*.pug',
		css: 'dev/css/**/*.*',
		js: 'dev/js/*.*',
		img: 'dev/images/**/*.*'
	},
	node_modules : 'node_modules/'
};

/* HTML */
gulp.task('html', function(){
	gulp.src(path.dev.html)
		.pipe(pug({pretty: true}))
		.pipe(gulp.dest(path.dist.html))
		.pipe(browserSync.reload({stream: true}));
});

gulp.task('checkHtml', function(){
	gulp.src('dist/**/*.html')
		.pipe(htmlhint())
		.pipe(htmlhint.reporter())
		.pipe(gulp.dest(path.dist.html));
});

/* STYLES */

gulp.task('css', function(){
	gulp.src([
		path.node_modules + 'normalize.css/normalize.css',
		'dev/css/libs/*.css'
	])
	.pipe(gulp.dest('dist/assets/css/libs'))
	.pipe(csso({
		restructure: false,
		sourceMap: false,
		//debug: true
	}))
	.pipe(concat('libs.css'))
	.pipe(gulp.dest(path.dist.css))

	gulp.src([
		'dev/css/main.sass'
	])	
	.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
	// .pipe(autoprefixer({
	// 	browsers: ['last 10 versions'],
	// 	cascade: true
	// }))
	.pipe(concat('app.css'))
	.pipe(csso({
		restructure: true,
		sourceMap: true,
	}))
	.pipe(gulp.dest(path.dist.css))
	.pipe(browserSync.reload({stream:true}));
});

/* JS */
gulp.task('libsJs', function(){
	gulp.src([
		'dev/js/libs/**.*'
	])
	.pipe(uglify())
	.pipe(gulp.dest('dist/assets/js/libs'))
	.pipe(concat('libs.js'))
	.pipe(gulp.dest(path.dist.js))
	.pipe(browserSync.reload({stream:true}));
});

gulp.task('js', function(){
	gulp.src(path.dev.js)
	.pipe(babel({
		presets: ['env']
	}))
	.pipe(uglify())
	.pipe(concat('script.js'))
	.pipe(gulp.dest(path.dist.js))
	.pipe(browserSync.reload({stream:true}));
});

/* IMAGES */
gulp.task('img', function(){
	gulp.src(path.dev.img)
		.pipe(imagemin([
		    imagemin.gifsicle({interlaced: true}),
		    imagemin.jpegtran({progressive: true}),
		    imagemin.optipng({optimizationLevel: 5}),
		    imagemin.svgo({plugins: [{removeViewBox: true}]})
		]))
		.pipe(gulp.dest(path.dist.img))
})

/* FONTS */
gulp.task('fonts', function(){
	gulp.src(path.dev.fonts)
	.pipe(gulp.dest(path.dist.fonts))
})

/* CLEAN */
gulp.task('clean', function(){
	return del('dist');
});

/* WEBSERVER */
gulp.task('webserver', function() {
	browserSync.init({
		//tunnel: true,
		server: {
			baseDir: "dist/",
		},
	});
});


/* WATCH */
gulp.task('watch', function(){
	//watch html
	gulp.watch([path.watch.html], function(){
		gulp.start('html');
		//gulp.start('checkHtml');
	});
	//watch css
	gulp.watch(['dev/css/**/*.sass', 'dev/blocks/**/*.sass', 'dev/css/libs/*.*'], ['css']);
	//watch js
	gulp.watch([path.watch.js], ['js']);
	//watch img
	gulp.watch([path.watch.img], ['img']);
});

/* BUILD */
gulp.task('default', function(callback){
	runSequence(
		'checkHtml',
		'webserver',
		'watch',
		callback);
});

gulp.task('build', function(callback){
	runSequence(
		'clean',
		'html',
		'css',
		'js',
		'libsJs',
		'img',
		'fonts',
		 callback);
});

gulp.task('build:min', function(callback){
	runSequence(
		callback);
});

gulp.task('zip:final', function(callback){
	gulp.src('dist/**/*.*')
		.pipe(zip('archive.zip'))
		.pipe(gulp.dest(''))
});