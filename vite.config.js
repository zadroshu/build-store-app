import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';
import svgLoader from "vite-svg-loader";
import path from 'path';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    },
    plugins: [
        laravel(['resources/js/app.js', 'resources/css/app.scss']),
        Vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                }
            }
        }),
        svgLoader(),
    ],
    resolve: {
        alias: {
          '~fa': path.resolve(__dirname, 'node_modules/@fortawesome/fontawesome-free/scss'),
          ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue.js'),
        },
      },
      css: {
        preprocessorOptions: {
          scss: {
            additionalData: `@import "resources/css/variables.scss";`
          }
        }
      },
});
