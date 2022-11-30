let fileswatch = 'php,html,htm,txt,json,md,woff2,scss' // List of files extensions for watching & hard reload
const config   = require( './config' );

const { src, dest, parallel, series, watch } = require( 'gulp' )
const browserSync                            = require( 'browser-sync' ).create()
const sass                                   = require( 'gulp-sass' )
const autoprefixer                           = require( 'gulp-autoprefixer' )
const rename                                 = require( 'gulp-rename' )
const imagemin                               = require( 'gulp-imagemin' )
const newer                                  = require( 'gulp-newer' )
const rsync                                  = require( 'gulp-rsync' )
const del                                    = require( 'del' );
const webpackStream                          = require( 'webpack-stream' );
const webpack                                = require( 'webpack' );
const webpackConfig                          = require( './webpack.config.js' );
const minify                                 = require( 'gulp-minify' );

function browsersync() {
	browserSync.init( config.webserver );
}


function scripts() {
	return src( 'assets/js/*.js' )
	.pipe( webpackStream( webpackConfig ) )
	.on(
		'error',
		function handleError() {
			this.emit( 'end' )
		}
	)
	.pipe(
		minify(
			{
				ext:{
					src:'.js',
					min:'.min.js'
				},
				exclude: ['tasks'],
				ignoreFiles: ['.combo.js', '-min.js']
			}
		)
	)
	.pipe( dest( 'dist/js' ) )
	.pipe( browserSync.stream() )

}
function scripts_modules() {
	return src( 'modules/**/*.js' )
	.pipe( webpackStream( webpackConfig ) )
	.on(
		'error',
		function handleError() {
			this.emit( 'end' )
		}
	)
	.pipe(
		minify(
			{
				ext:{
					src:'.js',
					min:'.min.js'
				},
				exclude: ['tasks'],
				ignoreFiles: ['.combo.js', '-min.js']
			}
		)
	)
	.pipe( dest( 'dist/js' ) )
	.pipe( browserSync.stream() )

}

function styles() {
	return src( 'assets/scss/**/*.scss' )
	.pipe( sass( { outputStyle: 'compressed' } ) )
	.pipe( autoprefixer( { overrideBrowserslist: ['last 10 versions'], grid: true } ) )
	.pipe( dest( 'dist/css' ) )
	.pipe( browserSync.stream() )
}

function styles_modules() {
	return src( 'modules/**/*.scss' )
	.pipe( sass( { outputStyle: 'compressed' } ) )
	.pipe( autoprefixer( { overrideBrowserslist: ['last 10 versions'], grid: true } ) )
	.pipe( dest( 'dist/css/modules/' ) )
	.pipe( browserSync.stream() )
}

function styles_blocks() {
	return src( 'template-parts/blocks/**/*/*.scss', {base: './'} )
	.pipe( sass( { outputStyle: 'compressed' } ) )
	.pipe( autoprefixer( { overrideBrowserslist: ['last 10 versions'], grid: true } ) )
	.pipe( dest( './' ) )
	.pipe( browserSync.stream() )
}

function images() {
	return src( 'assets/img/src/**/*' )
	.pipe( newer( 'app/img/dest' ) )
	.pipe( imagemin() )
	.pipe( dest( 'assets/img/dest' ) )
}

function cleanimg() {
	return del( 'assets/img/dest/**/*', { force: true } )
}

function deploy() {
	return src( 'assets/' )
	.pipe(
		rsync(
			{
				root: 'assets/',
				hostname: 'username@yousite.com',
				destination: 'yousite/public_html/',
				include: [/* '*.htaccess' */], // Included files to deploy,
				exclude: [ '**/Thumbs.db', '**/*.DS_Store' ],
				recursive: true,
				archive: true,
				silent: false,
				compress: true
			}
		)
	)
}

function startwatch() {
	watch( ['assets/scss/**/*','assets/scss/**/*.scss'], { usePolling: true }, styles );
	watch( ['assets/scss/cards/*.scss','assets/scss/**/*.scss'], { usePolling: false }, styles );
	watch( 'modules/**/*.scss', { usePolling: false }, styles_modules );
	watch( 'template-parts/**/*.scss', { usePolling: false }, styles_blocks );
	watch( ['modules/**/*.js', '!app/js/**/*.min.js'], { usePolling: true }, scripts_modules );
	watch( ['assets/**/**/*.js', '!app/js/**/*.min.js'], { usePolling: true }, scripts );
	watch( 'assets/img/src/**/*.{jpg,jpeg,png,webp,svg,gif}', { usePolling: true }, images );
	watch(` * */*.{${fileswatch}}`, { usePolling: true }).on('change', browserSync.reload);
}

exports.assets   = series( cleanimg, scripts, images )
exports.scripts  = scripts
exports.styles   = styles
exports.images   = images
exports.cleanimg = cleanimg
exports.deploy   = deploy
exports.default  = series( scripts, images, styles, parallel( browsersync, startwatch ) );
