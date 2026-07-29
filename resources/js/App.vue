<template>
  <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center p-6">
    <div class="flex items-center gap-4 mb-8">
      <div class="logo"></div>
      <h1 class="text-4xl font-bold text-gray-900">
        Интеграция виджета на сайт
      </h1>
    </div>

    <div class="text-lg text-gray-700">
      Чтобы подключить виджет, вставьте этот фрагмент кода в шаблон вашего сайта.
    </div>
    <div class="code-block text-lg my-4">
      <pre
        class="rounded-lg text-fluid-base shadow-lg shadow-blue-400/60 relative overflow-hidden max-w-full h-full"><code
        id="code">&lt;script data-skip-moving="true"&gt;
  var _vikaSettings = _vikaSettings || {};
  (function (w, d, u) {
    var s = d.createElement('script');
    s.async = 1;
    s.src = u + '?' + (Date.now() / 60000 | 0);
    var h = d.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s, h);
  })(window, document,'{{ launcherUrl }}');
&lt;/script&gt;</code></pre>
    </div>
    <div class="text-gray-600">
      Виджет не требует от сервера вашего сайта дополнительных ресурсов.
    </div>
  </div>
</template>

<script>
import hljs from 'highlight.js/lib/core';
import CopyButtonPlugin from 'highlightjs-copy';
import 'highlightjs-copy/dist/highlightjs-copy.min.css';
import xml from 'highlight.js/lib/languages/xml';
import javascript from 'highlight.js/lib/languages/javascript';
import 'highlight.js/styles/atom-one-dark.css';

export default {
  name: 'HomePage',
  computed: {
    launcherUrl() {
      return `${import.meta.env.VITE_APP_URL}/build-vika-launcher/launcher.js`;
    }
  },
  mounted() {
    hljs.registerLanguage('xml', xml);
    hljs.registerLanguage('javascript', javascript);
    hljs.addPlugin(new CopyButtonPlugin());
    hljs.highlightAll();
  },
};
</script>

<style scoped>
.logo {
  width: 100px;
  height: 100px;
  min-height: 100px;
  background: url("../assets/logo-big.svg") no-repeat center;
  background-size: 100px;
}
</style>
