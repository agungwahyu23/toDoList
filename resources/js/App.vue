<template>
  <Navbar v-if="showNavbar" />
  <router-view />
</template>

<script>
import Navbar from './components/Navbar.vue';

export default {
  name: 'App',
  components: {
    Navbar,
  },
  computed: {
    showNavbar() {
      const hideOn = ['/login', '/register', '/'];
      return !hideOn.includes(this.$route.path) && !!localStorage.getItem('token');
    },
  },
}
</script>
