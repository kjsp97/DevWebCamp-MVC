import path from 'path'
import fs from 'fs'
import {glob} from 'glob'
import {src, dest, watch, series} from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'
import terser from 'gulp-terser'
import cleanCSS from 'gulp-clean-css'
import sharp from 'sharp'
// import concat from 'gulp-concat';
// import through2 from 'through2'
import sourcemaps from 'gulp-sourcemaps'
import rename from 'gulp-rename'
import webpack from 'webpack-stream';

// const isProduction = process.env.NODE_ENV === 'production'

const sass = gulpSass(dartSass)

function js() {
    return src('src/js/**/*.js')
        .pipe(webpack({
            mode: 'production',
            // watch: 'true',
            entry: './src/js/app.js',
            module: {
                rules : [
                    {
                        test: /\.css$/i,
                        use:['style-loader', 'css-loader']
                    }
                ]
            }
        }))
        .pipe(sourcemaps.init())
        // .pipe(concat('bundle.js'))
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('.'))  
        .pipe(dest('./public/build/js'))
}


export function css(done) {
    src('src/scss/app.scss', {sourcemaps: true})
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(dest('public/build/css', {sourcemaps: '.'}))
    done()
}

//Codigo Nodejs para transformar a webp y jpg
export async function imagenes(done) {
    const srcDir = './src/img';
    const buildDir = 'public/build/img';
    const images =  await glob('./src/img/**/*{jpg,png}')

    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        procesarImagenes(file, outputSubDir);
    });
    done();
}
//destino de transformar webp y jpg
function procesarImagenes(file, outputSubDir) {
    if (!fs.existsSync(outputSubDir)) {
        fs.mkdirSync(outputSubDir, { recursive: true })
    }
    const baseName = path.basename(file, path.extname(file))
    const extName = path.extname(file)

    if (extName.toLowerCase() === '.svg') {
        // If it's an SVG file, move it to the output directory
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        fs.copyFileSync(file, outputFile);
    } else {
    const outputFile = path.join(outputSubDir, `${baseName}${extName}`)
    const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`)

    const options = { quality: 80 }
    sharp(file).jpeg(options).toFile(outputFile)
    sharp(file).webp(options).toFile(outputFileWebp)
    }
}

export function dev() {
    watch('src/scss/**/*.scss', css); 
    watch('src/js/**/*.js', js); 
    watch('src/img/**/*.{png,jpg}', imagenes);     
}


export default series(js, css, imagenes, dev);
export const build = series(js, css, imagenes);