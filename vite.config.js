import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; // 👈 Add this line


export default defineConfig({
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js', // 👈 important line
        },
    },
    plugins: [
        vue(), // 👈 And this line
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
