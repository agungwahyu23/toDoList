import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/Login.vue';
import Dashboard from '../pages/Dashboard.vue';
import TaskList from '../pages/TaskList.vue';
import TaskCreate from '../pages/TaskCreate.vue';
import TaskEdit from '../pages/TaskEdit.vue';

const routes = [
    { path: '/', component: Login },
    { path: '/dashboard', component: Dashboard },
    { path: '/tasks', component: TaskList },
    { path: '/task/create', component: TaskCreate },
    { path: '/task/edit/:id', component: TaskEdit, props: true },
    { path: '/login', component: Login },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
  
    if (to.meta.requiresAuth && !token) {
      next('/login');
    } else if (to.meta.guest && token) {
      next('/tasks');
    } else {
      next();
    }
  });

export default router;