/**
 * Ресайз изображений через sharp.
 * Использование: node scripts/resize-images.cjs
 * Или:           npm run resize-images
 *
 * Редактируй массив TASKS ниже под свои нужды.
 */

const sharp = require('sharp');
const path  = require('path');
const fs    = require('fs');

const BASE = path.join(__dirname, '..', 'public', 'images');

const TASKS = [
    // { src, dest, width }  — height рассчитывается автоматически (пропорции сохраняются)
    { src: 'about-photo.webp',   dest: 'about-photo.webp',   width: 900 },
    { src: 'contact-photo.webp', dest: 'contact-photo.webp', width: 900 },
    { src: 'laravel-mark.webp',  dest: 'laravel-mark.webp',  width: 300 },
];

(async () => {
    for (const task of TASKS) {
        const input  = path.join(BASE, task.src);
        const output = path.join(BASE, task.dest);

        if (!fs.existsSync(input)) {
            console.warn(`⚠  Файл не найден: ${input}`);
            continue;
        }

        const inputBuffer = fs.readFileSync(input);
        const meta        = await sharp(inputBuffer).metadata();
        const before      = Math.round(fs.statSync(input).size / 1024);

        if (meta.width <= task.width) {
            console.log(`✓  ${task.src} — уже ${meta.width}px, пропускаем`);
            continue;
        }

        const buffer = await sharp(inputBuffer)
            .resize({ width: task.width, withoutEnlargement: true })
            .webp({ quality: 85 })
            .toBuffer();

        fs.writeFileSync(output, buffer);

        const after = Math.round(fs.statSync(output).size / 1024);
        console.log(`✓  ${task.src}: ${meta.width}px → ${task.width}px | ${before}KB → ${after}KB`);
    }
})();
