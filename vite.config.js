import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
                ],
            refresh: true, // 啟用 Blade 與路由變更時的自動刷新
        }),
    ],
    resolve: {
        alias: {
            // 設定別名，方便 SCSS 中直接使用 '~bootstrap' 等前綴
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~@fontsource': path.resolve(__dirname, 'node_modules/@fontsource'),
            '~admin-lte': path.resolve(__dirname, 'node_modules/admin-lte'),
            '~sweetalert2': path.resolve(__dirname, 'node_modules/sweetalert2'),
        }
    },
    build: {
        chunkSizeWarningLimit: 2048, // 避免 AdminLTE 打包過大時的警告
    }
});
