import { createRouter } from "vue-router";
import { createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/', component: () => import('./components/Index'),
            name: 'index',
        },
        {
            path: '/create', component: () => import('./components/Create'),
            name: 'create'
        },
        { 
            path: '/404', component: () => import('./components/NotFound'),
            name: 'page404'
        },
        {
            path: '/:catchAll(.*)', redirect: '/404',
        },
    ],
})


export default router
