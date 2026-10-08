import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/documents.css', 'resources/css/qa.css', 'resources/css/contacts.css', 'resources/css/reviews.css', 'resources/css/slider.css', 'resources/js/app.js', 'resources/css/fontello.css', 'resources/css/filament/admin/theme.css', 'resources/css/unco.css'],
            refresh: true,
        }),
    ],
});
