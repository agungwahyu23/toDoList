<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand" href="#">Laravue</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <router-link class="nav-link" to="/dashboard">Home</router-link>
                    </li>
                </ul>
                <button @click="logout" class="btn btn-danger">Logout</button>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from 'axios';

export default {
  methods: {
    async logout() {
      try {
        await axios.post('/logout');
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
        this.$router.push('/login');
      } catch (error) {
        console.error('Logout error', error);
      }
    },
  },
};
</script>
