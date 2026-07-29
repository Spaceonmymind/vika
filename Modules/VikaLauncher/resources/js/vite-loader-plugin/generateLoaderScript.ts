import {promises as fs} from 'fs';
import {resolve} from 'path';
import {Plugin} from 'vite';
import {Eta} from 'eta';

export interface LoaderScriptPluginOptions {
    /** Папка сборки */
    distDir?: string;
    /** Entrypoint с файла манифеста */
    entryName?: string;
    /** В какой файл сохранить */
    loaderFilename?: string;
    /** Базовый путь в паблике */
    publicPath?: string;
    /** Путь до файла шаблона */
    templatePath?: string;
}

export default function generateLoaderScriptPlugin(
    options: LoaderScriptPluginOptions = {}
): Plugin {
    const {
        distDir = '../../public/build-vika-launcher',
        entryName = '/resources/js/app.js',
        loaderFilename = 'launcher.js',
        publicPath = '/build-vika-launcher/',
        templatePath = './scripts/loaderTemplate.eta',
    } = options;

    return {
        name: 'generate-load-bundle',
        apply: 'build',
        async closeBundle() {
            try {
                const projectRoot = process.cwd();
                const outputDir = resolve(projectRoot, distDir);
                const manifestFile = resolve(outputDir, 'manifest.json');

                const raw = await fs.readFile(manifestFile, 'utf-8');
                const manifest = JSON.parse(raw);
                const manifestJson = JSON.stringify(
                    {
                        file: manifest[entryName].file,
                        css: manifest[entryName].css,
                    },
                    null,
                    2
                );

                // Шаблонизатор для JS https://eta.js.org/docs/
                const eta = new Eta({views: projectRoot});
                const scriptContent = await eta.renderAsync(templatePath, {
                    manifestJson,
                    publicPath,
                });

                const scriptPath = resolve(outputDir, loaderFilename);
                await fs.writeFile(scriptPath, scriptContent, 'utf-8');

                this.info(`✅ Loader script generated: ${scriptPath}`);
            } catch (err) {
                this.error(
                    `Error generating loader script: ${(err as Error).message}`
                );
            }
        }
    };
}
