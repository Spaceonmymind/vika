import path from 'path'
import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import Vue from "@vitejs/plugin-vue";
import collectModuleAssetsPaths from './vite-module-loader.js';

import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import Icons from 'unplugin-icons/vite'
import IconsResolver from 'unplugin-icons/resolver'
import {ElementPlusResolver} from 'unplugin-vue-components/resolvers'
import {visualizer} from 'rollup-plugin-visualizer'

const pathSrc = path.resolve(__dirname, 'resources/js')

async function getConfig() {
    const paths = [
        'resources/css/app.css',
        'resources/js/app.ts',
    ];

    const allPaths = await collectModuleAssetsPaths(paths, 'Modules');
    return defineConfig({
        plugins: [
            Vue(),
            laravel({
                input: allPaths ,
                refresh: true,
            }),
            AutoImport({
                imports: [
                    'vue',
                    'pinia',
                    {
                        'vue-router': ['createRouter', 'createWebHistory'],
                    },
                    {
                        'axios': [
                            ['default', 'axios'], // import { default as axios } from 'axios',
                        ],
                    },
                ],
                resolvers: [
                    ElementPlusResolver(),
                    IconsResolver({
                        prefix: 'Icon',
                    }),
                ],
                dts: path.resolve(pathSrc, 'auto-imports.d.ts'),
            }),
            Components({
                resolvers: [
                    ElementPlusResolver(),
                    IconsResolver({
                        enabledCollections: ['ep'],
                    }),
                ],
                dts: path.resolve(pathSrc, 'components.d.ts'),
            }),
            Icons({
                compiler: 'vue3',
                autoInstall: true,
            }),
        ],
        build: {
            rollupOptions: {
                plugins: [
                    visualizer({open: false})
                ]
            }
        },
        server: {
            cors: true,
        },
    });
}

export default getConfig();
