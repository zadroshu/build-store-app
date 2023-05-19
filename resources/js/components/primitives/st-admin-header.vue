<template>
    <div class="st-app-admin-header">
      <div class="st-app-admin-header__toolbar">
          <st-label class="st-app-admin-header__link" value="Товары" @click="router.push({name:'admin'})" />
          <st-label class="st-app-admin-header__link" value="Категории" @click="router.push({name:'adminCategory'})" />
          <st-label class="st-app-admin-header__link" value="Заказы" />
          <st-label class="st-app-admin-header__link" value="Администраторы" />
      </div>
    </div>
  </template>
  
<script setup>
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { computed } from 'vue';

const store = useStore();
const router = useRouter();

const totalQuantity = computed(() => { 
    return store.getters['cart/totalQuantity'];
}); 

function goHome() {
    router.push({name: 'admin'});
};

</script>
  
<style lang="scss">
.st-app-admin-header {

    width: 100%;
    background-color: $--st-white;
    margin-bottom: $--st-offset-xs;
    flex: 0 0 auto;

    &__toolbar {
    display: flex;
    justify-content:  space-evenly;
    align-items: center;
    margin: $--st-offset-xs $--st-offset-xl;
    }

    &__link {
      cursor: pointer;
      text-decoration: underline;
    }
}
  </style>
  