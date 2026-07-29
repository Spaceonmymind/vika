import {createApp} from 'vue';
import App from './App.vue';

const containerId = 'vika-widget';
let container = document.getElementById(containerId);
if (!container) {
    container = document.createElement('div');
    container.id = containerId;
    document.body.appendChild(container);
}

createApp(App).mount(`#${containerId}`);
