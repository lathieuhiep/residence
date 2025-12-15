const gulp = require('gulp')
const {src, dest, watch} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const uglify = require('gulp-uglify')
const cleanCSS = require('gulp-clean-css')
const rename = require("gulp-rename")
const plumber = require('gulp-plumber');
const gulpIf = require('gulp-if');
const webpack = require('webpack-stream');
const TerserPlugin = require('terser-webpack-plugin');

require('dotenv').config()

// setting NODE_ENV: development or production
const isDev = (process.env.NODE_ENV === 'development');

// Biến đại diện cho tên plugin và theme
const pluginNameEFA = 'essential-features-addon';
const themeName = 'blankwp';

// Đường dẫn file
const paths = {
    node_modules: 'node_modules/',
    vendors: 'src/vendors/',
    plugins: {
        root: 'src/plugins/',
        efa: {
            scss: `src/plugins/${pluginNameEFA}/scss/`,
            js: `src/plugins/${pluginNameEFA}/js/`
        }
    },
    theme: {
        scss: 'src/theme/scss/',
        js: 'src/theme/js/'
    },
    shared: {
        scss: 'src/shared/scss/',
        vendors: 'src/shared/scss/vendors/',
    },
    output: {
        theme: {
            root: `themes/${themeName}/assets/`,
            css: `themes/${themeName}/assets/css/`,
            js: `themes/${themeName}/assets/js/`,
            libs: `themes/${themeName}/assets/libs/`,
            woo: `themes/${themeName}/includes/woocommerce/assets/`
        },
        plugins: {
            root: 'plugins/',
            efa: {
                css: `plugins/${pluginNameEFA}/assets/css/`,
                js: `plugins/${pluginNameEFA}/assets/js/`,
                libs: `plugins/${pluginNameEFA}/assets/libs/`
            }
        }
    }
};

// server
// tạo file .env với biến PROXY="localhost/blank-wp". Có thể thay đổi giá trị này.
const proxy = process.env.PROXY || "localhost/blank-wp";

function server() {
    browserSync.init({
        proxy: proxy,
        open: false,
        cors: true,
        ghostMode: false
    })
}

// Task build vendors libraries
function buildStyleVendors() {
    return src(`${paths.vendors}*/**.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error('SCSS Style Vendors Error:', err.message);
                this.emit('end');
            }
        }))
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: ['node_modules', 'src']
        }, '').on('error', sass.logError))
        .pipe(cleanCSS({level: 2}))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${paths.output.theme.root}vendors`))
        .pipe(browserSync.stream())
}

// Task build style theme
function buildStyleTheme() {
    return src(`${paths.theme.scss}main.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error('SCSS Style Theme Error:', err.message);
                this.emit('end');
            }
        }))
        .pipe(gulpIf(isDev, sourcemaps.init()))
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: ['node_modules', 'src']
        }, '').on('error', sass.logError))

        // --- Xuất file chưa min ---
        .pipe(rename({suffix: '.bundle'}))
        .pipe(dest(`${paths.output.theme.css}`))

        // --- Tạo bản minified ---
        .pipe(cleanCSS({level: 2}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulpIf(isDev, sourcemaps.write()))
        .pipe(dest(`${paths.output.theme.css}`))
        .pipe(browserSync.stream())
}

function buildJSTheme() {
    return src([
        `${paths.theme.js}*.js`
    ], {allowEmpty: true})
        .pipe(plumber({
            errorHandler: function (err) {
                console.error('Error in build js in theme:', err.message);
                this.emit('end');
            }
        }))
        .pipe(webpack({
            mode: 'production',
            output: {
                filename: 'main.bundle.min.js'
            },
            module: {
                rules: [
                    {
                        test: /\.m?js$/,
                        exclude: /node_modules/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: ['@babel/preset-env']
                            }
                        }
                    }
                ]
            },
            resolve: {
                extensions: ['.js']
            },
            optimization: {
                minimize: true,
                minimizer: [
                    new TerserPlugin({
                        extractComments: false,
                        terserOptions: {
                            format: {
                                comments: false
                            },
                        },
                    })
                ]
            }
        }))
        .pipe(dest(`${paths.output.theme.js}`))
        .pipe(browserSync.stream())
}

/*
Task build project
* */
async function buildProject() {
    // theme
    await buildStyleVendors()
    await buildStyleTheme()

    await buildJSTheme()
}
exports.buildProject = buildProject

// Task watch
function watchTask() {
    server()

    // theme watch
    watch([
        `${paths.vendors}*/**.scss`,
    ], buildStyleVendors)

    watch([
        `${paths.theme.scss}abstracts/*.scss`,
        `${paths.theme.scss}base/*.scss`,
        `${paths.theme.scss}main.scss`,
    ], buildStyleTheme)

    watch([`${paths.theme.js}*.js`], buildJSTheme)
}

exports.watchTask = watchTask