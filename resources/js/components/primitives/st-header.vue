<template>
    <div class="st-app-header">
      <div class="st-app-header__toolbar">
        <div class="st-app-header__phone">
          8-961-502-50-40
        </div>
        <div class="st-app-header__logo" @click="goHome">
          <mainLogo />
        </div>
        <div class="st-app-header__cart">
            <div v-if="totalQuantity > 0" class="st-app-header__cart-counter">
                <st-label :value="totalQuantity" />
            </div>
            <div class="st-app-header__cart-icon">
                <cartIcon @click="goToCart" />
            </div>
        </div>
      </div>
    </div>
  </template>
  
<script setup>
import mainLogo from '../../../../public/assets/icons/logo.svg';
import cartIcon from '../../../../public/assets/icons/cart.svg';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { computed } from 'vue';

const store = useStore();
const router = useRouter();

const totalQuantity = computed(() => { 
    return store.getters['cart/totalQuantity'];
}); 

function goHome() {
    router.push({name: 'home'});
};

function goToCart() {
    router.push({name: 'cart'});
};
</script>
  
<style lang="scss">
.st-app-header {

    width: 100%;
    background-color: $--st-white;
    margin-bottom: $--st-offset-xs;
    flex: 0 0 auto;

    &__toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: $--st-offset-xs $--st-offset-xl;
    
    }

    &__cart {
        display: flex;
        align-items: center;
    }
    
    &__cart-counter {
        width: 3.25rem;
        height: 2.55rem;
        text-align: center;
        border: 1px solid $--st-gray;
        color: $--st-white;
        font-size: $--st-font-small;
        background: $--st-gray;
        border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        -khtml-border-radius: 50%;
    }

    &__logo {
        cursor: pointer;
    }

    &__cart-icon {
        cursor: pointer;
    }
}
  </style>
  