import Archiver from 'archiver';
import FS from 'fs';
import OS from 'os';

const exclude = [ 'themes.packages' ];

let themes = [];
let count = 0;

FS.readdirSync('../').forEach(file => {
    /* Ignoring hidden files */
    if(file.substr(0, 1) === '.') {
        return;
    }

    /* Ignoring other files */
    if(!exclude.indexOf(file)) {
        return;
    }

    /* Only use Directorys */
    if(FS.statSync('../' + file).isDirectory()) {
        ++count;
        console.log('[INFO] Found Theme:', file);

        const archive= Archiver('zip', {
            zlib: {
                level: 9
            },
            comment: 'Automatic packed by ThemePacker | fruithost'
        });

        const stream          = FS.createWriteStream('../themes.packages/' + file + '.zip');

        archive.directory('../' + file, true).on('finish', () => {
            console.info('[INFO] Packed: ', file, '~> themes.packages/' + file + '.zip');
            themes.push(file);
        }).on('error', error => {
            console.error('[ERROR]', error);
        }).on('warning', warning => {
            console.warn('[WARNING]', warning);
        }).pipe(stream);

        archive.finalize();
    }
});

let _watcher = setInterval(() => {
    if(themes.length == count) {
        clearInterval(_watcher);
        console.info('[INFO] Update themes.list');
        themes.sort();

        FS.writeFile('../themes.list', themes.join(OS.EOL), error => {
            if (error) {
                console.error('[ERROR]', error);
            } else {
                console.info('[INFO] themes.list updated with ', themes.length, ' Themes');
            }
        });
    }
});