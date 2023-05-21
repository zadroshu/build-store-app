<template>
    <div class="st-login">
        <st-label class="st-login__header" value="Вход" />
        <div class="st-login__body">
            <st-input v-model="email" type="email" placeholder="Email" />
            <st-input v-model="password" type="password" placeholder="Password" />
            <st-button class="st-login__btn" value="Отправить" @click.prevent="login" />
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { dataservice } from '../App.vue';

export default {
    data() {
        return {
            email: null,
            password: null,
        };
      
   },
   
   methods: {
        login() {
            axios.get('/sunctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                })
                .then(response => {
                    localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN']);
                    this.$router.push({name: 'admin'});
                })
                .catch(err => {
                    console.log(err.response);
                });
            });
        },
   }
}
</script>

<style lang="scss">
.st-login {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    &__header {
        font-size: $--st-font-big;
    }
    &__body {
        padding: $--st-offset-xl;
        border: 1px solid $--st-white;
        border-radius: 20px;
        background-color: $--st-white;
    }
    &__btn {
        margin-top: $--st-offset-l;

        .st.st-button {
            padding: 0.7rem 1.2rem;
        }
    }
}

</style>