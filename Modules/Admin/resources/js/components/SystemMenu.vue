<template>
  <div class="system-menu white-box">
    <div>
      <router-link
        v-for="(item,index) in menu"
        :key="item.title+index"
        v-slot="{ navigate, href, isActive }"
        :to="item.link"
        custom
      >
        <div v-if="isAccess(item.permissions)" :class="['item-menu', isActive ? 'active' : '' ]">
          <div class="title-item-menu">
            <div
              :class="['ico', item.ico ? item.ico : '']"
            />
            <a :href="href" @click="navigate">{{ item.title }}</a>
            <div
              v-if="item.child"
              class="arrow"
            />
          </div>
          <div
            v-if="item.child"
            class="child-menu"
          >
            <router-link
              v-for="(itemChild,indexChild) in item.child"
              :key="itemChild.title+indexChild"
              v-slot="{navigate, href, isActive }"
              :to="itemChild.link"
              custom
            >
              <div v-if="isAccess(itemChild.permissions)" :class="['item-child-menu', isActive ? 'active' : '' ]">
                <div class="title-item-child-menu">
                  <div
                    :class="['ico','small', itemChild.ico ? itemChild.ico : '']"
                  />
                  <a :href="href" @click="navigate">{{ itemChild.title }}</a>
                </div>
              </div>
            </router-link>
          </div>
        </div>
      </router-link>
      <div v-if="user.name==='adminko'" class="item-menu">
        <div class="title-item-menu">
          <div  class="ico horison">
          </div><a href="/horizon/" target="_blank">Laravel Horizon</a>
        </div>
      </div>
    </div>


  </div>
</template>

<script>
import {useAppStore} from '../store/index.js';

export default {
  name: 'SystemMenu',
  data() {
    return {
      menu: [
        {
          title: 'Домашняя страница',
          link: '/home',
          ico: 'home'
        },
        {
          title: 'Пользователи',
          link: '/users',
          permissions: ['administrate_roles', 'administrate_users'],
          ico: 'users',
          child: [
            {
              title: 'Список пользователей',
              link: '/users/list',
              ico: 'user-list',
              permissions: ['administrate_users']
            },
            {
              title: 'Список ролей',
              link: '/users/roles',
              ico: 'key',
              permissions: ['administrate_roles']
            }
          ],
        },
        {
          title: 'Виджеты',
          link: '/widgets',
          ico: 'widgets',
          permissions: ['administrate_widgets', 'administrate_vika_types'],
          child: [
            {
              title: 'Список виджетов',
              link: '/widgets/list',
              permissions: ['administrate_widgets']
            },
            {
              title: 'Типы Vika',
              link: '/widgets/vika-type',
              permissions: ['administrate_vika_types']
            },
            {
              title: 'Панель виджетов',
              link: '/widgets/panel',
              permissions: ['administrate_widgets', 'administrate_vika_types']
            },
          ],
        },
        /*        {
                  title: 'Telegram',
                  link: '/telegram',
                  ico: 'telegram'
                },*/
        {
          title: 'Управление чатом',
          link: '/chat',
          ico: 'chat',
          permissions: ['administrate_chat','administrate_ai'],
          child: [
            {
              title: 'Ответы',
              link: '/chat/answers',
              permissions: ['administrate_chat'],
            },
            {
              title: 'Интенты',
              link: '/chat/intents',
              permissions: ['administrate_ai'],
            },
            {
              title: 'Тестирование',
              link: '/chat/test',
              permissions: ['administrate_ai'],
            },
            {
              title: 'БЯМ',
              link: '/chat/test-llm',
              permissions: ['administrate_ai'],
            },
          ],
        },
        {
          title: 'СтопГраффити',
          link: '/stop-graffiti',
          ico: 'chat',
          permissions: ['manage_stop_graffiti'],
        },
        {
          title: 'Актировки',
          link: '/cold',
          ico: 'cold',
          permissions: ['actirovki'],
          child: [
            {
              title: 'Объявить актировку',
              link: '/cold/today',
              permissions: ['actirovki'],
            },
            {
              title: 'Актировки',
              link: '/cold/history',
              permissions: ['actirovki'],
            },
            {
              title: 'Статистика',
              link: '/cold/statistic',
              permissions: ['actirovki'],
            },
            {
              title: 'Погода',
              link: '/cold/weather',
              permissions: ['actirovki'],
            },
            {
              title: 'Управление городами',
              link: '/cold/city',
              permissions: ['actirovki'],
            },
          ],
        },
        {
          title: 'Статистика',
          link: '/statistics',
          ico: 'statistics',
          permissions: ['administrate_widgets_statistic','get_intents_statistic'],
          child: [
            {
              title: 'Виджеты',
              link: '/statistics/widgets',
              permissions: ['administrate_widgets_statistic'],
            },
            {
              title: 'Интенты',
              link: '/statistics/intents',
              permissions: ['get_intents_statistic'],
            },
          ]
        },
        /*{
          title: 'Настройки',
          link: '/settings',
          ico: 'settings',
          child: [
            {
              title: 'Общие',
              link: '/settings/all',
            },
            {
              title: 'Системные',
              link: '/settings/system',
            }
          ],
        }*/
      ],
    };
  },
  computed: {
    ...mapState(useAppStore, ['user',]),
  },
  methods: {
    isAccess(permissions) {
      if (permissions !== undefined) {
        if (permissions.some(permission => {
          return this.user?.permissions.map(item => item.name).includes(permission);
        })) {
          return true;
        }else{
          return false;
        }
      } else {
        return true;
      }
    }
  }

};
</script>

<style scoped>
.system-menu {
  display: grid;
  width: 300px;
}

.title-item-menu a {
  font-size: 16px;
  font-weight: 500;
  color: var(--vika-link-color);
  text-decoration: none;
}

.title-item-child-menu a {
  font-size: 14px;
  font-weight: 500;
  color: var(--vika-link-color);
  text-decoration: none;
}

.title-item-menu {
  display: flex;
  gap: 5px;
  align-items: center;
  justify-content: flex-start;
}

.title-item-child-menu {
  display: flex;
  gap: 5px;
  align-items: center;
  justify-content: flex-start;

  padding-bottom: 10px;
}

.item-menu {
  padding-bottom: 12px;
}

.item-menu:last-child {
  padding-bottom: 0;
}

.child-menu .item-child-menu:last-child .title-item-child-menu {
  padding-bottom: 0;
}

.ico {
  width: 25px;
  height: 25px;

  background-color: var(--vika-ico-color);

  mask-image: url("../../assets/icons/Sort_Right.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 25px;
}

.title-item-menu a:hover, .title-item-child-menu a:hover {
  color: var(--vika-active-color);
}

.arrow {
  transform: rotate(180deg);

  width: 25px;
  height: 25px;
  margin-left: auto;

  background-color: var(--vika-ico-color);

  mask-image: url("../../assets/icons/Top_Arrow_5.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 25px;
}

.item-menu.active .arrow {
  display: none;
}


.title-item-menu:has(a:hover) .ico, .title-item-menu:has(a:hover) .arrow {
  background-color: var(--vika-active-color);
}

.title-item-child-menu:has(a:hover) .ico, .title-item-child-menu:has(a:hover) .arrow {
  background-color: var(--vika-active-color);
}

.ico.small {
  width: 18px;
  height: 18px;

  mask-size: 18px;
}

.ico.home {
  mask-image: url("../../assets/icons/Home_17.svg");
}

.ico.statistics {
  mask-image: url("../../assets/icons/Chart_Mixed.svg");
}

.ico.settings {
  mask-image: url("../../assets/icons/Setting_5.svg");
}

.ico.all {
  mask-image: url("../../assets/icons/Setting.svg");
}

.ico.system {
  mask-image: url("../../assets/icons/Setting_Gear.svg");
}

.ico.users {
  mask-image: url("../../assets/icons/Users.svg");
}

.ico.widgets {
  mask-image: url("../../assets/icons/Thunder.svg");
}

.ico.telegram {
  mask-image: url("../../assets/icons/Send.svg");
}

.ico.service {
  mask-image: url("../../assets/icons/Binary.svg");
}

.ico.cold {
  mask-image: url("../../assets/icons/Snow.svg");
}

.ico.key {
  mask-image: url("../../assets/icons/key.svg");
}

.ico.user-list {
  mask-image: url("../../assets/icons/Users_3.svg");
}

.ico.chat {
  mask-image: url("../../assets/icons/comments_3.svg");
}

.ico.horison {
  mask-image: url("../../assets/icons/horison.svg");
  mask-size: 17px;
}


.item-menu .child-menu {
  display: none;
}

.item-menu.active .child-menu {
  display: grid;
  padding-top: 12px;
  padding-left: 25px;
}


.item-menu.active .title-item-menu a, .item-child-menu.active .title-item-child-menu a {
  color: var(--vika-active-color);
}

.item-menu.active .title-item-menu .ico, .item-child-menu.active .title-item-child-menu .ico {
  background-color: var(--vika-active-color);
}

@media (width <= 768px) {
  .system-menu {
    width: initial;
  }
}

</style>
