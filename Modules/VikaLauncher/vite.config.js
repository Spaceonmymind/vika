import {defineConfig, loadEnv} from 'vite';
import laravel from 'laravel-vite-plugin';
import Vue from "@vitejs/plugin-vue";
import generateLoaderScript from './resources/js/vite-loader-plugin/generateLoaderScript.js';

async function getConfig(mode) {
    const env = loadEnv(mode, '../../', 'VITE_')
    return defineConfig({
        base: `${env.VITE_APP_URL}/build-vika-launcher/`,
        envDir: '../../',
        build: {
            outDir: '../../public/build-vika-launcher',
            emptyOutDir: true,
            manifest: 'manifest.json'
        },
        plugins: [
            laravel({
                publicDirectory: '../../public',
                buildDirectory: 'build-vika-launcher',
                input: [
                    __dirname + '/resources/js/app.ts'
                ],
                refresh: true,
            }),
            Vue(),
            generateLoaderScript({
                distDir: '../../public/build-vika-launcher',
                entryName: 'resources/js/app.ts',
                loaderFilename: 'launcher.js',
                publicPath: `${env.VITE_APP_URL}/build-vika-launcher/`,
                templatePath: '/resources/js/vite-loader-plugin/loaderTemplate.eta',
            }),
        ],
    });
}

export default getConfig();
