import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

// export default defineConfig({ mode }=>{})
export default ({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };

    return defineConfig({
        server: {
            host: process.env.APP_HOSTS,
        },
        plugins: [
            laravel({
                input: [
                    'resources/js/app.js',
                ],
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            })
        ],
        resolve: {
            alias: {
                vue: 'vue/dist/vue.esm-bundler.js',
                '$':  'jQuery',
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                replacement: '$1',
            },
        },
        optimizeDeps: {
            exclude: [
              "toastr"
            ]
        },
        build: {
            rollupOptions: {
              output: {
                assetFileNames: 'assets/js/[name].css',
                entryFileNames: 'assets/js/[name].js',
                // Set output.assetFileNames to configure the asset filenames (for media files and stylesheets).
                // Set output.chunkFileNames to configure the vendor chunk filenames.
                // Set output.entryFileNames to configure the index.js filename.
                // https://stackblitz.com/edit/vitejs-output-file-paths?file=vite.config.js
              },
            },
        },
    });
}
