<template>
    <div class="st-cart">
        <div v-if="cart?.length > 0" class="st-cart__grid">
            <st-label class="st-cart__grid-header" :bold="true" value="Наименование товара"/>
            <st-label class="st-cart__grid-header" value="Количество" />
            <st-label class="st-cart__grid-header" value="Стоимость"/>
            <st-label class="st-cart__grid-header" value=""/>
            <template v-for="cartItem in cart" :key="cartItem?.product?.id">
                <st-label class="st-cart__grid-item" :value="cartItem?.product?.name"/>
                <st-label class="st-cart__grid-item" :value="cartItem.quantity" />
                <st-label class="st-cart__grid-item" :value="cartItem?.product?.cost * cartItem.quantity"/>
                <div class="st-cart__grid-item"  @click="deleteFromCart(cartItem)"><deleteIcon class="st-cart__delete-icon" /></div>
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
    margin: 0 auto;
    display: grid;
    grid-template-columns: auto auto auto min-content;
    justify-content: center;
    align-items: center;
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

  &__grid-header {
    font-weight: 700;
    margin-right: 2rem;
  }

  &__grid-item {
    height: 2rem;
    border-top: 1px solid;
  }


}
</style>
  