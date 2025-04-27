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

// Pengaturan default untuk Bearer Token (jika ada token yang disimpan di localStorage)
const token = localStorage.getItem('token');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

window.$ = window.jQuery = $;

const app = createApp(App);
app.use(router);
app.mount('#app');