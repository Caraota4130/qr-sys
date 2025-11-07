import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/custom-variables.scss',
                'resources/css/app.css', 

                'resources/js/app.js',
                'resources/js/utils/ColorToggle.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
