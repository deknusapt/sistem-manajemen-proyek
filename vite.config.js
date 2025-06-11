import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/projects.js',
                'resources/js/materials.js',
                'resources/js/clients.js',
                'resources/js/users.js',
            ],
            refresh: true,
        }),
    ],
});
