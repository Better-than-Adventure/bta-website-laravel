import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/scss/app.scss",
                "resources/scss/admin.scss",
                "resources/js/simpleMDE.js",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "~fonts": path.resolve(__dirname, "resources/assets/fonts"),
            "~easyMDE": path.resolve(__dirname, "node_modules/easymde"),
            "~use-bootstrap-tag": path.resolve(__dirname, "node_modules/use-bootstrap-tag"),
        },
    },
});
