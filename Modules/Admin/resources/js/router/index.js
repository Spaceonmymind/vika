import {useAppStore} from '../store/index';

const routes = [
    {
        path: '/',
        redirect: '/home',
        component: () => import( '../views/BasePage.vue'),
        meta: {
            requiresAuth: true,
            roles: ['superuser']
        },
        children: [
            {
                path: 'home',
                name: 'home',
                component: () => import( '../components/HomePage.vue'),
                meta: {
                    title: 'Домашняя страница',
                }
            },
            {
                path: 'users',
                redirect: '/users/list',
                component: () => import( '../views/TemplatePage.vue'),
                meta: {
                    title: 'Пользователи',
                    permissions:['administrate_roles','administrate_users']
                },
                children: [
                    {
                        path: 'list',
                        name: 'users-list',
                        component: () => import( '../components/Users/UsersList.vue'),
                        meta: {
                            title: 'Список пользователей',
                            permissions:['administrate_users']
                        }
                    },
                    {
                        path: 'roles',
                        name: 'roles-list',
                        component: () => import( '../components/Users/RolesList.vue'),
                        meta: {
                            title: 'Список ролей',
                            permissions:['administrate_roles']
                        }
                    },
                ]
            },
            {
                path: 'widgets',
                name: 'widgets',
                redirect: '/widgets/list',
                component: () => import( '../views/TemplatePage.vue'),
                meta: {
                    title: 'Виджеты',
                    permissions:['administrate_widgets','administrate_vika_types']
                },
                children: [
                    {
                        path: 'list',
                        name: 'widget-list',
                        component: () => import( '../components/Widget/WidgetList.vue'),
                        meta: {
                            title: 'Управление виджетами',
                            permissions:['administrate_widgets']
                        }
                    },
                    {
                        path: 'vika-type',
                        name: 'vika-type',
                        component: () => import( '../components/Widget/VikaType.vue'),
                        meta: {
                            title: 'Типы Vika',
                            permissions:['administrate_vika_types']
                        }
                    },
                    {
                        path: 'panel',
                        name: 'panel',
                        component: () => import( '../components/Widget/WidgetPanel.vue'),
                        meta: {
                            title: 'Панель виджетов',
                            permissions:['administrate_widgets','administrate_vika_types']
                        }
                    },
                ]
            },
            {
                path: 'chat',
                redirect: '/chat/answers',
                component: () => import( '../views/TemplatePage.vue'),
                meta: {
                    title: 'Управление чатом',
                    permissions:['administrate_chat','administrate_ai']
                },
                children: [
                    {
                        path: 'answers',
                        name: 'answers-list',
                        component: () => import( '../components/Chat/AnswersList.vue'),
                        meta: {
                            title: 'Ответы',
                            permissions:['administrate_chat']
                        }
                    },
                    {
                        path: 'intents',
                        name: 'intents-list',
                        component: () => import( '../components/Chat/IntentsList.vue'),
                        meta: {
                            title: 'Интенты',
                            permissions:['administrate_ai']
                        }
                    },
                    {
                        path: 'test',
                        name: 'intents-test',
                        component: () => import( '../components/Chat/TestIntent.vue'),
                        meta: {
                            title: 'Тестирование интентов',
                            permissions:['administrate_ai']
                        }
                    },
                    {
                        path: 'test-llm',
                        name: 'test-llm',
                        component: () => import( '../components/Chat/TestLLM.vue'),
                        meta: {
                            title: 'Тестирование БЯМ',
                            permissions:['administrate_ai']
                        }
                    },
                ]
            },
            {
                path: 'stop-graffiti',
                name: 'stop-graffiti',
                component: () => import('../components/StopGraffiti/ReportsList.vue'),
                meta: {
                    title: 'СтопГраффити',
                    permissions: ['manage_stop_graffiti']
                }
            },
            {
                path: 'cold',
                name: 'cold',
                redirect: '/cold/today',
                component: () => import( '../views/TemplatePage.vue'),
                meta: {
                    title: 'Актировки',
                    permissions:['actirovki']
                },
                children: [
                    {
                        path: 'today',
                        name: 'cold-today',
                        component: () => import( '../components/Cold/ColdToday.vue'),
                        meta: {
                            title: 'Объявить актировку',
                            permissions:['actirovki']
                        }
                    },
                    {
                        path: 'history',
                        name: 'cold-history',
                        component: () => import( '../components/Cold/ColdHistory.vue'),
                        meta: {
                            title: 'Актировки',
                            permissions:['actirovki']
                        }
                    },
                    {
                        path: 'statistic',
                        name: 'cold-statistic',
                        component: () => import( '../components/Cold/ColdStatistic.vue'),
                        meta: {
                            title: 'Статистика',
                            permissions:['actirovki']
                        }
                    },
                    {
                        path: 'weather',
                        name: 'cold-weather',
                        component: () => import( '../components/Cold/WeatherHistory.vue'),
                        meta: {
                            title: 'Погода',
                            permissions:['actirovki']
                        }
                    },
                    {
                        path: 'city',
                        name: 'cold-city-control',
                        component: () => import( '../components/Cold/CityControl.vue'),
                        meta: {
                            title: 'Управление городами',
                            permissions:['actirovki']
                        }
                    },
                ]
            },
            {
                path: 'statistics',
                name: 'statistics',
                redirect: '/statistics/widgets',
                component: () => import( '../views/TemplatePage.vue'),
                meta: {
                    title: 'Статистика',
                    permissions:['administrate_widgets_statistic','get_intents_statistic']
                },
                children: [
                    {
                        path: 'widgets',
                        name: 'widgets-statistic',
                        component: () => import( '../components/Statistic/WidgetStatistic.vue'),
                        meta: {
                            title: 'Статистика по виджетам',
                            permissions:['administrate_widgets_statistic']
                        }
                    },
                    {
                        path: 'intents',
                        name: 'intents-statistic',
                        component: () => import( '../components/Statistic/IntentStatistic.vue'),
                        meta: {
                            title: 'Статистика интентов',
                            permissions:['get_intents_statistic']
                        }
                    },
                ]
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: () => import( '../views/LoginPage.vue'),
        meta: {
            title: 'Вход',
        }
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: () => import( '../views/ResetPasswordPage.vue'),
        meta: {
            title: 'Восстановление пароля',
        }
    },
    {
        path: '/no-access',
        name: 'NoAccess',
        component: () => import( '../views/NoAccess.vue'),
        meta: {
            title: 'Нет доступа',
        }
    },
    {
        path: '/404',
        name: '404',
        component: () => import('../views/PageNotFound.vue')

    },
    {
        path: '/:catchAll(.*)',
        redirect: '/404'
    }
];

// Создаем роутер
const router = createRouter({
    history: createWebHistory('/admin/'),
    routes,
});


router.beforeEach(async (to, from, next) => {
    const store = useAppStore();

    // при первой загрузке страницы
    if (to.meta.requiresAuth && !store.user) {
        await store.fetchUser();
    }

    // проверка авторизации
    if (to.meta.requiresAuth && !store.user) {
        return next('/login');
    }

    // проверка роли
    /*if (to.meta.roles && !to.meta.roles.some(role => {
        if (store.user?.roles.map(item => item.name).includes('superuser')) {
            return true;
        } else {
            return store.user?.roles.map(item => item.name).includes(role);
        }
    })) {
        return next('/no-access');
    }*/

    if (to.meta.permissions && !to.meta.permissions.some(permission => {
        return store.user?.permissions.map(item => item.name).includes(permission);
    })) {
        return next('/no-access');
    }

    next();
});


// Глобальный перехватчик, который срабатывает после каждого перехода
router.afterEach((to) => {
    // Если в meta текущего маршрута есть title — устанавливаем, иначе можно указать дефолт
    document.title = to.meta.title || 'Vika';
});


export default router;
