<template>
    <div class="st-cart">
        <div v-if="cart?.length > 0" class="st-cart__grid">
            <template v-for="cartItem in cart" :key="cartItem?.product?.id">
            <st-label :value="cartItem?.product?.name"/>
            <st-label :value="cartItem.quantity" />
            <st-label :value="cartItem?.product?.cost"/>
            <deleteIcon class="st-cart__delete-icon" @click="deleteFromCart(cartItem)"/>
            </template>
        </div>
    
        <div v-else>
            Корзина пуста :(
        </div>
    </div>
</template>
  
<script setup>

import { useStore, mapGetters } from 'vuex';
import deleteIcon from '../../../public/assets/icons/delete-icon.svg';
import { computed } from "vue";
  
const store = useStore();

const cart = computed(() => { 
    return store.getters['cart/cart'];
}); 

async function deleteFromCart(cartItem) {
    store.dispatch('cart/deleteFromCart', cartItem);
};


</script>
  
<style lang="scss">
.st-cart {
  &__grid {
    display: grid;
    grid-template-columns: auto auto auto min-content;
    justify-content: center;
    align-items: center;
    grid-gap: $--st-offset-xl;
  }

  &__delete-icon:hover {
    fill: $--st-red;
    transition: .2s;
  }

  &__delete-icon {
    width: $--st-offset-l;
    height: $--st-offset-l;
    cursor: pointer;
    fill: $--st-gray;
  }


}
</style>
  