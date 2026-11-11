import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/header-footer.css",
                "resources/css/accessible.css",
                "resources/css/documents.css",
                "resources/css/qa.css",
                "resources/css/contacts.css",
                "resources/css/reviews.css",
                "resources/css/slider.css",
                "resources/js/app.js",
                "resources/css/fontello.css",
                "resources/css/unco.css",
                "resources/css/projects.css",
                "resources/css/unco_show.css",
                "resources/css/clinic.css",
                "resources/css/specialists.css",
                "resources/css/specialist_show.css",
                "resources/css/servicescategorysectionsall.css",
                "resources/css/servicescategorysections.css",
                "resources/css/servicescategories.css",
                "resources/css/services.css",
                "resources/css/promotions.css",
                "resources/css/hero.css",
                "resources/css/home-services.css",
                "resources/css/home-clinic.css",
                "resources/css/home-results.css",
                "resources/css/home-specialists.css",
                "resources/css/home-projects.css",
                "resources/css/home-work.css",
                "resources/css/prices.css",
            ],
            refresh: true,
        }),
    ],
});
