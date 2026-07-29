import {defineConfig} from 'eslint/config';
import eslintConfigPrettier from 'eslint-config-prettier';
import eslintPluginVue from 'eslint-plugin-vue';
import globals from 'globals';
import tseslint from 'typescript-eslint';

export default defineConfig([
    {
        ignores: [
            '**/*.d.ts',
            '**/coverage',
            '**/dist',
            '**/vendor'
        ],
    },
    ...tseslint.configs.recommended,
    {
        extends: [
            ...eslintPluginVue.configs['flat/recommended'],
            eslintConfigPrettier
        ],
        files: [
            "resources/js/**/*.{js,ts,vue}",
            "Modules/*/resources/js/**/*.{js,ts,vue}"
        ],
        rules: {
            "linebreak-style": ["error", "unix"],
            "quotes": ["error", "single"],
            "semi": ["error", "always"]
        },
        languageOptions: {
            sourceType: 'module',
            globals: {
                ...globals.browser
            }
        }
    }
]);
