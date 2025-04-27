import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/Login.vue';
import Dashboard from '../pages/Dashboard.vue';
import TaskList from '../pages/TaskList.vue';
import TaskCreate from '../pages/TaskCreate.vue';
import TaskEdit from '../pages/TaskEdit.vue';
import Register from '../pages/Register.vue';

const routes = [
    { path: '/', component: Login, meta: { guest: true } },
    { path: '/dashboard', component: TaskList, meta: { requiresAuth: true } },
    { path: '/tasks', component: TaskList, meta: { requiresAuth: true } },
    { path: '/task/create', component: TaskCreate, meta: { requiresAuth: true } },
    { path: '/task/edit/:id', component: TaskEdit, props: true, meta: { requiresAuth: true } },
    { path: '/login', component: Login, meta: { guest: true } },
    { path: '/register', component: Register },
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