<template>
    <div class="container mt-5">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div class="mb-3">
                <input v-model="form.email" type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input v-model="form.password" type="password" class="form-control" placeholder="Password" required>
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
            form: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login(){
            axios.post('/api/v1/login', this.form)
            .then(res => {
                localStorage.setItem('token', res.data.token);
                this.$router.push('/dashboard');
            }).catch(
                () => alert('Login gagal!')
            );
        }
    }
}
</script>