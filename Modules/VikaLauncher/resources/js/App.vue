<template>
  <div v-if="!isHidden" id="vika-button">
    <div v-if="!isExpanded" class="small" @click="expandWidget">
      <div class="close-small" @click.stop="hideWidget"></div>
      <div class="figure-shadow"></div>
      <div class="figure-bg" role="button">
        <div
          v-for="icon in icons"
          :key="icon"
          :class="[ icon, { active: icon === currentIcon } ]"
          class="vi-ico"
        ></div>
      </div>
    </div>
    <div v-if="isExpanded" class="bg"></div>
    <div v-if="isExpanded" class="big">
      <div class="box-frame">
        <div class="fon"></div>
        <div class="close" title="Закрыть VIка" @click="closeWidget">
          <i></i><span>Закрыть VIка</span>
        </div>
        <iframe
          v-show="isIframeLoaded"
          id="iframe-vika-widget"
          :src="vikaUrl"
          allow="geolocation; microphone; camera"
          height="100%"
          style="border:0;"
          width="100%"
          @load="onIframeLoad">
        </iframe>
        <div v-show="!isIframeLoaded" class="preloader"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'VikaWidget',
  data() {
    return {
      isHidden: false,
      isExpanded: false,
      isIframeLoaded: false,
      icons: [
        'vi-logo',
        'vi-chat',
        'vi-sport',
        'vi-med',
        'vi-jkh',
        'vi-gas',
        'vi-child',
        'vi-bus',
        'vi-book'
      ],
      currentIcon: 'vi-logo',
      iconUpdateInterval: null,
    };
  },
  computed: {
    vikaUrl() {
      return `${import.meta.env.VITE_APP_URL}/vika/`;
    }
  },
  watch: {
    isExpanded(value) {
      // Если Сафари - открыть в новом окне. Сафари на маке может быть на движке хрома.
      if (value && navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Chrome') === -1) {
        window.open(this.vikaUrl, '_blank');
      }
    }
  },
  created() {
    this.currentIcon = this.icons[0];
    this.iconUpdateInterval = setInterval(() => {
      this.icons.push(this.icons.shift());   // первый элемент в конец
      this.currentIcon = this.icons[0];      // новый текущий
    }, 5000);
  },
  beforeUnmount() {
    if (this.iconUpdateInterval) {
      clearInterval(this.iconUpdateInterval);
    }
  },
  methods: {
    onIframeLoad(event) {
      this.isIframeLoaded = true;
      const iframe = event.target;
      iframe.contentWindow.postMessage({ type: 'whoami', origin: window.location.origin }, '*');
    },
    expandWidget() {
      this.isExpanded = true;
    },
    closeWidget() {
      this.isExpanded = false;
      this.isIframeLoaded = false;
    },
    hideWidget() {
      this.isHidden = true;
    },
  }
};
</script>

<!--suppress CssUnusedSymbol -->
<style scoped>
#vika-button .small {
  cursor: pointer;

  position: fixed;
  z-index: 9999;
  right: 0;
  bottom: 0;
  zoom: 0.8;

  display: flex;
  align-items: center;
  justify-content: center;
}

#vika-button .small .figure-shadow {
  z-index: 1;

  width: 197px;
  height: 204px;

  opacity: 0.8;
  background: url("../assets/img/form-shadow.png") no-repeat;

  animation: zoom-widget 2.5s infinite;
}

#vika-button .small .figure-bg {
  position: absolute;
  z-index: 10;

  display: flex;
  align-items: center;
  justify-content: center;

  width: 123px;
  height: 132px;

  background: url("../assets/img/form-bg1.png") no-repeat;

  animation: in-zoom-widget 2.5s infinite;
}

#vika-button .small .vi-ico {
  position: absolute;
  z-index: 15;
  top: 0;
  left: 0;

  width: 46px;
  height: 46px;

  opacity: 0;
  background-repeat: no-repeat;
  background-position: center !important;
  background-size: 33px;
  filter: brightness(0) invert(1);
}

#vika-button .small .vi-ico.active {
  position: relative; /* чтобы активная стояла поверх остальных */
  opacity: 1;
}

#vika-button .small .vi-chat {
  background-image: url("../assets/img/chat.svg");
}

/* noinspection CssUnusedSymbol */
#vika-button .small .vi-logo {
  background-image: url("../assets/img/vi.svg");
}

/* noinspection CssUnusedSymbol */
#vika-button .small .vi-sport {
  background-image: url("../assets/img/vi-sport.svg");
}

/* noinspection CssUnusedSymbol */
#vika-button .small .vi-gas {
  background-image: url("../assets/img/vi-gas.svg");
}

/* noinspection CssUnusedSymbol */
#vika-button .small .vi-med {
  background-image: url("../assets/img/vi-med.svg");
}

/* noinspection CssUnusedSymbol */
#vika-button .small .vi-jkh {
  background-image: url("../assets/img/vi-jkh.svg");
}

/* noinspection CssUnusedSymbol */
#vika-button .small .vi-child {
  background-image: url("../assets/img/vi-child.svg");
}

/* noinspection ALL */
#vika-button .small .vi-bus {
  background-image: url("../assets/img/vi-bus.svg");
}

/* noinspection CssUnusedSymbol */
#vika-button .small .vi-book {
  background-image: url("../assets/img/vi-book.svg");
}

#vika-button .close-small {
  position: absolute;
  z-index: 10;
  right: 23px;
  bottom: 167px;

  width: 30px;
  height: 30px;

  background-color: #1e3685;

  mask-image: url("../assets/img/close.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 17px;
}

#vika-button .fon {
  display: none;
}

#vika-button .bg {
  position: fixed;
  z-index: 9998;
  top: 0;
  right: 0;

  width: 100%;
  height: 100%;

  background: rgb(133 133 133 / 75%);

}

#vika-button .box-frame {
  position: relative;

  display: flex;
  align-items: center;
  justify-content: center;

  width: 500px;
  height: 100%;

  background: #ccc;
}

#vika-button .big {
  position: fixed;
  z-index: 9999;
  top: 0;
  right: 0;

  display: flex;
  justify-content: flex-end;

  width: 100%;
  height: 100%;

  background: rgb(0 0 0 / 50%);
}

#vika-button .big .close {
  cursor: pointer;

  position: absolute;
  top: 18px;
  left: -50px;

  display: flex;
  align-items: center;
  justify-content: center;

  box-sizing: content-box;
  width: 35px;
  height: 35px;
  border-radius: 50px;

  opacity: 1;
  background: #fff;

  transition: 0.3s ease;
}

#vika-button .big .close i {
  width: 11px;
  height: 11px;

  background-color: #000;

  mask-image: url("../assets/img/close.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 11px;
}

#vika-button .big .close span {
  display: none;
}

#vika-button .big .close:hover {
  opacity: 0.8;
}

#vika-button .big .preloader {
  width: 128px;
  height: 32px;
  background: url("../assets/img/preloader.svg") no-repeat;
}

@media (width <= 768px) {
  #iframe-vika-widget {
    box-sizing: border-box;
    padding-top: 50px;
  }

  #vika-button .big .close {
    top: 7px !important;
    left: 14px !important;
    width: 160px !important;
  }

  #vika-button .fon {
    position: absolute;
    top: 0;
    left: 0;

    display: block !important;

    width: 100%;
    height: 50px;

    background: #e0e0e0;
  }

  #vika-button .big .close span {
    display: inline !important;

    margin-left: 5px !important;

    font-family: sans-serif;
    font-size: initial;
    font-weight: normal;
    line-height: 1;
    color: #000;
    text-shadow: initial;
  }

}

@keyframes zoom-shadow {
  from {
    transform: scale(0.9);
  }

  to {
    transform: scale(1);
  }
}

@keyframes zoom-widget {
  0% {
    transform: scale(0, 0);
  }

  50% {
    transform: scale(1, 1);
  }

  100% {
    transform: scale(0, 0);
  }
}

@keyframes in-zoom-widget {
  0% {
    transform: scale(1, 1);
  }

  50% {
    transform: scale(0.9, 0.9);
  }

  100% {
    transform: scale(1, 1);
  }
}
</style>
