import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import istanbul from 'vite-plugin-istanbul'
import tsconfigPaths from 'vite-tsconfig-paths'

export default defineConfig({
    base: '/',
    plugins: [
        laravel({
            input: ['./resources/ts/app.ts'],
            refresh: true,
        }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                }
            }
        }),
        istanbul({
            include: [
                './resources/ts/pages/**/*.{ts,vue}',
                './resources/ts/components/**/*.{ts,vue}',
                './resources/ts/states/**/*.{ts,vue}',
            ],
            exclude: ['node_modules', 'test', 'tests'],
            extension: ['.js', '.ts', '.vue'],
            cypress: true,
            forceBuildInstrument: true
        }),
        tsconfigPaths(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/ts'),
        }
    },
    test: {
        environment: 'jsdom',
        globals: true,
        include: ['./resources/ts/tests/**/*.test.{ts,ts}', './resources/ts/tests/**/*.spec.{ts,ts}'],
        watch: false,
        setupFiles: ['./resources/ts/tests/setup.ts'],
        coverage: {
            provider: 'v8',
            reporter: ['text', 'lcov'],
            reportsDirectory: './storage/coverage/ts',
            include: [
                'resources/ts/pages/**/*.{ts,vue}',
                'resources/ts/components/**/*.{ts,vue}',
                'resources/ts/states/**/*.{ts,vue}',
            ],
            exclude: [
                'resources/ts/assets/**',
                'resources/ts/locales/**',
                '**/*.png',
                '**/*.jpg',
                '**/*.svg',
                '**/*.css',
                '**/*.json'
            ]
        }
    }
});
