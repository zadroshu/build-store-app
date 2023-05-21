<template>
    <div class="st-app-admin-header">
      <div class="st-app-admin-header__toolbar">
          <st-label class="st-app-admin-header__link" value="Товары" @click="router.push({name:'admin'})" />
          <st-label class="st-app-admin-header__link" value="Категории" @click="router.push({name:'adminCategory'})" />
          <st-label class="st-app-admin-header__link" value="Заказы" @click="router.push({name:'adminOrder'})" />
          <st-label class="st-app-admin-header__link" value="Администраторы" @click="router.push({name:'adminAdministrators'})" />
        </div>
        <st-label class="st-app-admin-header__link" value="Выход" @click.prevent="logout" />
    </div>
  </template>
<script setup>
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

async function logout() {
  axios.post('/logout').then(response => {
    localStorage.removeItem('x_xsrf_token');
    router.push({name: 'login'});
  });
};

</script>
  
<style lang="scss">
.st-app-admin-header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    background-color: $--st-brown;
    margin-bottom: $--st-offset-xs;
    flex: 0 0 auto;

    &__toolbar {
    width: 60%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin: $--st-offset-xs $--st-offset-xl;
    }

    &__link {
      color: $--st-white;
      cursor: pointer;
      text-decoration: underline;
    }
}
  </style>
  