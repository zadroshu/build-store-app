<template>
    <div class="st-app-header">
      <div class="st-app-header__toolbar">
        <div class="st-app-header__phone">
          8-961-502-50-40
        </div>
        <div class="st-app-header__logo" @click="goToHome">
          <mainLogo />
        </div>
        <div class="st-app-header__cart">
            <div v-if="cartCount > 0" class="st-app-header__cart-counter">
            
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
</script>

<script>
import { dataservice } from '../../App.vue';

export default {
    data() {
        return {
            cartCount: 0,
        }
    },

    methods: {
        async getCart() {
            return await dataservice.cart.get();
        },

        getCartCount(data) {
            data.forEach(item => this.cartCount += item.quantity);
        },

        goToCart() {
            this.$router.push({name: 'cart', params: { products: [{id: 1, name: 'Test', cost: 1090 }] }});
        },

        goToHome() {
            this.$router.push({name: 'home'});
        },
    },

    async mounted() {
        console.log((await this.getCart()).data);
    },
}
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
        width: 2.25rem;
        height: 1.75rem;
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
  