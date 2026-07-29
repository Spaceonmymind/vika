// src/plugins/webapp.js
let loadScriptPromise;
/*if (typeof window !== 'undefined' && window.crypto && !window.crypto.randomUUID) {
    window.crypto.randomUUID = function randomUUID() {
        // RFC 4122 v4
        const bytes = new Uint8Array(16);
        window.crypto.getRandomValues(bytes);

        // https://stackoverflow.com/a/2117523
        bytes[6] = (bytes[6] & 0x0f) | 0x40; // version 4
        bytes[8] = (bytes[8] & 0x3f) | 0x80; // variant 10

        const hex = Array.from(bytes, (b) => b.toString(16).padStart(2, '0')).join('');
        return (
            hex.substr(0, 8) + '-' +
            hex.substr(8, 4) + '-' +
            hex.substr(12, 4) + '-' +
            hex.substr(16, 4) + '-' +
            hex.substr(20)
        );
    };
}*/

function loadBridge() {
    if (loadScriptPromise) return loadScriptPromise;
    loadScriptPromise = new Promise((resolve, reject) => {
        // Если WebApp уже есть (например, скрипт подключён в index.html)
        if (window.WebApp) return resolve(window.WebApp);

        const s = document.createElement('script');
        s.src = 'https://st.max.ru/js/max-web-app.js';
        s.async = true;
        s.onload = () => {
            if (window.WebApp) resolve(window.WebApp);
            else reject(new Error('WebApp not found after script load'));
        };
        s.onerror = (e) => reject(e);
        document.head.appendChild(s);
    });
    return loadScriptPromise;
}

export default {
    install(app) {
        // публичные свойства для Options API
        app.config.globalProperties.$webapp = null;
        app.config.globalProperties.$_webappReady = loadBridge().then(webapp => {
            app.config.globalProperties.$webapp = webapp;
            return webapp;
        }).catch(err => {
            console.error('WebApp bridge load error', err);
            throw err;
        });
    }
};
