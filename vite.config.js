import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        // Laravel config
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // Vue config
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        cors: {
            origin: [
                // https://laravel.com/docs/12.x/vite#cors
                // Example: Allow all origins for given top-level domain, such as *.laravel
                // Supports: SCHEME://DOMAIN.laravel[:PORT] => /^https?:\/\/.*\.laravel(:\d+)?$/,
                'http://127.0.0.1:8000', // removes cors browser error caused by /api/posts
                'http://localhost:8000', // removes cors browser error caused by /api/posts
                'http://local-2.evaluation.pshsa.ca:8000', // removes cors browser error caused by /api/posts
                'http://local.tincan-prototypes.com', // removes cors browser error
                // 'https://cloud.scorm.com/lrs/QA82DLPXCA/', // removes cors browser error
            ],
        },
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            // To better import files and instead of going back directories with dots: `../../` ,use alias: `@`
            '@': '/resources/js',
        },
    },
});
