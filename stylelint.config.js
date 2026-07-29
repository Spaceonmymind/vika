/** @type {import('stylelint').Config} */
export default {
    root: true,
    customSyntax: 'postcss-html',
    extends: [
        'stylelint-config-standard',
        'stylelint-config-recommended-vue',
        'stylelint-config-clean-order'
    ],
    ignoreFiles: [
        '**/node_modules/**',
        '**/vendor/**',
        '**/dist/**',
        '**/coverage/**',
        '**/*.js',
        '**/*.jsx',
        '**/*.tsx',
        '**/*.ts'
    ],
    rules: {
        'no-empty-source': null, // пустые <style> в .vue
        'selector-class-pattern': null // Для element plus
    },
};
