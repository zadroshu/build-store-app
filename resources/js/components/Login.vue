<template>
    <div class="st-login">
        <div class="st-login__body">
            <st-input v-model="email" type="email" placeholder="Email" />
            <st-input v-model="password" type="password" placeholder="Password" />
            <st-button class="st-login__btn" value="Отправить" @click.prevent="login" />
            <st-button class="st-login__btn" value="get" @click.prevent="get" />

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
        console.log(this.email, this.password);
        axios.get('/sunctum/csrf-cookie').then(response => {
            axios.post('/login', {
                email: this.email,
                password: this.password,
            }).then(response => {
                console.log(response);
            });
        });
      },

      async get() {
        console.log(await dataservice.orders.get());
      },
   }
}
</script>

<style lang="scss">
.st-login {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    &__body {
        margin: auto
    }
    &__btn {
        margin-top: $--st-offset-l;
    }
}

</style>