import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        vue(), // write this
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
