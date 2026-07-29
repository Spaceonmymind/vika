// Импортируем компоненты
const ChatWindow = () => import( '../views/ChatWindow.vue');
const ViWidget = () => import( '../views/ViWidget.vue');

// Определяем маршруты
const routes = [
    {
        path: '/',
        name: 'chat',
        component: ChatWindow
    },
    {
        path: '/widget',
        redirect:'/widget/list',
        component: ViWidget,
        name: 'widget',
        children: [
            {
                path: 'proxy/:widgetName',
                name: 'widget-proxy',
                component: () => import('../components/Widget/ProxyWidget.vue'),
            },
            {
                path: 'proxy',
                redirect:'/widget/list'
            },
            {
                path: 'proxy-max',
                name: 'proxy-max',
                component: () => import('../components/Widget/ProxyMax.vue'),
            },
            {
                path: 'list',
                name: 'widget-list',
                component: () => import('../components/Chat/WidgetList.vue'),
                meta:{
                    title: 'Все сервисы',
                }
            },
            {
                path: 'vi-gas',
                name: 'vi-gas',
                component: () => import('../components/ViWidget/ViGas.vue'),
                meta:{
                    title: 'Цены на топливо',
                }
            },
            {
                path: 'vi-book',
                name: 'vi-book',
                component: () => import('../components/ViWidget/ViBook.vue'),
                meta:{
                    title: 'Телефонный справочник',
                }
            },
            {
                path: 'vi-med',
                name: 'vi-med',
                component: () => import('../components/ViWidget/ViMed.vue'),
                meta:{
                    title: 'Медицинские участки',
                }
            },
            {
                path: 'vi-doctor-appointment',
                name: 'vi-doctor-appointment',
                component: () => import('../components/ViWidget/ViDoctorAppointment.vue'),
                meta:{
                    title: 'Запись на прием к врачу',
                }
            },
            {
                path: 'vi-doctor-tmk',
                name: 'vi-doctor-tmk',
                component: () => import('../components/ViWidget/ViDoctorTMK.vue'),
                meta:{
                    title: 'Запись на ТМК',
                }
            },
            {
                path: 'vi-med-org-search',
                name: 'vi-med-org-search',
                component: () => import('../components/ViWidget/ViMedOrgSearch.vue'),
                meta:{
                    title: 'Поиск медицинских организаций',
                }
            },
            {
                path: 'vi-doctor-home-visit',
                name: 'vi-doctor-home-visit',
                component: () => import('../components/ViWidget/ViDoctorHomeVisit.vue'),
                meta:{
                    title: 'Вызов врача на дом',
                }
            },
            {
                path: 'vi-region-head-hotline',
                name: 'vi-region-head-hotline',
                component: () => import('../components/ViWidget/ViRegionHeadHotline.vue'),
                meta:{
                    title: 'Прямая линия с Губернатором Югры',
                }
            },
            {
                path: 'vi-tabel',
                name: 'vi-tabel',
                component: () => import('../components/ViWidget/ViTabel.vue'),
                meta:{
                    title: 'Статус сотрудника ИО',
                }
            },
            {
                path: 'vi-employment-ugra',
                name: 'vi-employment-ugra',
                component: () => import('../components/ViWidget/ViEmploymentUgra.vue'),
                meta:{
                    title: 'Занятость в Югре',
                }
            },
            {
                path: 'vi-pfr-help',
                name: 'vi-pfr-help',
                component: () => import('../components/ViWidget/ViPFRHelp.vue'),
                meta:{
                    title: 'Меры государственной поддержки родителей',
                }
            },
            {
                path: 'vi-application-status-mfc',
                name: 'vi-application-status-mfc',
                component: () => import('../components/ViWidget/ViApplicationStatusMFC.vue'),
                meta:{
                    title: 'Статус заявления',
                }
            },
            {
                path: 'vi-loss-person',
                name: 'vi-loss-person',
                component: () => import('../components/ViWidget/ViLossPerson.vue'),
                meta:{
                    title: 'Алгоритм действий при утрате близкого человека',
                }
            },
            {
                path: 'vi-state-key',
                name: 'vi-state-key',
                component: () => import('../components/ViWidget/ViStateKey.vue'),
                meta:{
                    title: 'Госключ',
                }
            },
            {
                path: 'vi-ugra-team',
                name: 'vi-ugra-team',
                component: () => import('../components/ViWidget/ViUgraTeam.vue'),
                meta:{
                    title: 'Команда Югры',
                }
            },
            {
                path: 'vi-pushkin-card',
                name: 'vi-pushkin-card',
                component: () => import('../components/ViWidget/ViPushkinCard.vue'),
                meta:{
                    title: 'Пушкинская карта',
                }
            },
            {
                path: 'vi-archive-ugra',
                name: 'vi-archive-ugra',
                component: () => import('../components/ViWidget/ViArchiveUgra.vue'),
                meta:{
                    title: 'Архив Югры',
                }
            },
            {
                path: 'vi-vet-clinic',
                name: 'vi-vet-clinic',
                component: () => import('../components/ViWidget/ViVetClinic.vue'),
                meta:{
                    title: 'Список ветеринарных клиник',
                }
            },
            {
                path: 'vi-walking-areas',
                name: 'vi-walking-areas',
                component: () => import('../components/ViWidget/ViWalkingAreas.vue'),
                meta:{
                    title: 'Места выгула и дрессировки',
                }
            },
            {
                path: 'vi-animals-shelters',
                name: 'vi-animals-shelters',
                component: () => import('../components/ViWidget/ViAnimalShelters.vue'),
                meta:{
                    title: 'Перечень приютов для животных',
                }
            },
            {
                path: 'vi-social-help',
                name: 'vi-social-help',
                component: () => import('../components/ViWidget/ViSocialHelp.vue'),
                meta:{
                    title: 'Меры социальной поддержки',
                }
            },
            {
                path: 'vi-business-help',
                name: 'vi-business-help',
                component: () => import('../components/ViWidget/ViBusinessHelp.vue'),
                meta:{
                    title: 'Меры поддержки предпринимателей',
                }
            },
            {
                path: 'vi-it-help',
                name: 'vi-it-help',
                component: () => import('../components/ViWidget/ViITHelp.vue'),
                meta:{
                    title: 'Меры поддержки ИТ-компаний',
                }
            },
            {
                path: 'vi-kmns-help',
                name: 'vi-kmns-help',
                component: () => import('../components/ViWidget/ViKMNSHelp.vue'),
                meta:{
                    title: 'Навигатор по услугам для КМНС',
                }
            },
            {
                path: 'vi-culture-ugra',
                name: 'vi-culture-ugra',
                component: () => import('../components/ViWidget/ViCultureUgra.vue'),
                meta:{
                    title: 'Культура Югры',
                }
            },
            {
                path: 'vi-dgz-help',
                name: 'vi-dgz-help',
                component: () => import('../components/ViWidget/ViDGZHelp.vue'),
                meta:{
                    title: 'Госзакупки',
                }
            },
            {
                path: 'vi-abbreviation',
                name: 'vi-abbreviation',
                component: () => import('../components/ViWidget/ViAbbreviation.vue'),
                meta:{
                    title: 'Аббревиатура',
                }
            },
            {
                path: 'vi-sport',
                name: 'vi-sport',
                component: () => import('../components/ViWidget/ViSport.vue'),
                meta:{
                    title: 'Спортивные секции',
                }
            },
            {
                path: 'vi-humanitarian-points',
                name: 'vi-humanitarian-points',
                component: () => import('../components/ViWidget/ViHumanitarianPoints.vue'),
                meta:{
                    title: 'Гуманитарные пункты приёма',
                }
            },
            {
                path: 'vi-system-help',
                name: 'vi-system-help',
                component: () => import('../components/ViWidget/ViSystemHelp.vue'),
                meta:{
                    title: 'Справочник информационных систем',
                }
            },
            {
                path: 'vi-actirovki',
                name: 'vi-actirovki',
                component: () => import('../components/ViWidget/ViActirovki.vue'),
                meta:{
                    title: 'Актировки',
                }
            },
        ]
    }
];

// Создаем роутер
const router = createRouter({
    history: createWebHistory('/vika/'),
    routes
});

// Глобальный перехватчик, который срабатывает после каждого перехода
router.afterEach((to) => {
    // Если в meta текущего маршрута есть title — устанавливаем, иначе можно указать дефолт
    document.title = to.meta.title || 'Vika';
});

export default router;
