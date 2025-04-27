import { createApp } from "vue";
import router from './router';
import App from './App.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import 'datatables.net-bs5';
import '@popperjs/core';
import axios from "axios";
import $ from 'jquery';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1/';

axios.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
}, error => {
    return Promise.reject(error);
});

axios.interceptors.response.use(response => response, error => {
    if (error.response.status === 401) {
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
        window.location.href = '/login';
    }
    return Promise.reject(error);
});

window.$ = window.jQuery = $;

const app = createApp(App);
app.use(router);
app.mount('#app');