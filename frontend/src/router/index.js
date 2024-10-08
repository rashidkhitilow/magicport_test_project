import { createRouter, createWebHistory } from 'vue-router';
import ProjectList from '@/components/ProjectList.vue';
import ProjectDetail from '@/components/ProjectDetail.vue';

const routes = [
    {
        path: '/',
        name: 'ProjectList',
        component: ProjectList,
    },
    {
        path: '/projects/:id',
        name: 'ProjectDetail',
        component: ProjectDetail,
        props: true,
        beforeEnter: (to, from, next) => {
            console.log('Navigating to ProjectDetail with ID:', to.params.id);
            next();
        },
    },
    {
        path: '/:catchAll(.*)',
        redirect: '/',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
