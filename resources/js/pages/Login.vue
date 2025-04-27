<template>
    <div class="container mt-5">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div class="mb-3">
                <input v-model="email" type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input v-model="password" type="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data(){
        return{
            email: '',
            password: '',
        }
    },
    methods: {
        async login() {
            try {
                const response = await axios.post('login', {
                    email: this.email,
                    password: this.password,
                });

                const token = response.data.token;
                localStorage.setItem('token', token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

                this.$router.push('/tasks');
            } catch (error) {
                console.error('Login gagal', error);
            }
        },
    }
}
</script>