<template>
  <div class="register">
    <h2>Register</h2>
    <form @submit.prevent="register">
        <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" v-model="name" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" v-model="email" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" v-model="password" class="form-control" required />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </form>
    <p>Already have an account? <router-link to="/login">Login here</router-link></p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
        name: '',
        email: '',
        password: '',
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password,
        });
        console.log('Registration successful:', response.data);
        this.$router.push('/login');
      } catch (error) {
        console.error('Registration failed:', error.response.data);
      }
    }
  }
};
</script>
