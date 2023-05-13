<template>
    <div class="st-cart">  
        <div v-if="cart?.length > 0" class="st-cart__content">
            <div class="st-cart__page-header">
                <st-label  value="КОРЗИНА" />
            </div>
            <div  class="st-cart__grid">
                <st-label value="Наименование товара" class="st-cart__header" />
                <st-label value="Количество" class="st-cart__header" />
                <st-label value="Стоимость" class="st-cart__header" />

                <template v-for="cartItem in cart">
                    <st-label :value="cartItem.product.name" class="st-cart__grid-item" />
                    <div class="st-cart__grid-item st-cart__counter">
                        <div class="st-cart__counter-item" @click="deleteFromCart(cartItem)"><minusIcon class="st-cart__grid-item st-cart__icon"  /></div>
                        <st-label :value="cartItem.quantity" class="st-cart__counter-item" />
                        <div class="st-cart__counter-item" @click="addToCart(cartItem.product)"><addIcon class="st-cart__grid-item st-cart__icon"  /></div>
                    </div>
                    <st-label :value="cartItem.product.cost * cartItem.quantity" class="st-cart__grid-item" />
                </template>
            </div>

            <div class="st-cart__total">
                <st-label :value="`ВСЕГО: ${totalCost}`" />
                <st-button value="Оформить заказ"/>
            </div>

            
        </div>

        <div v-else>
            Корзина пуста :(
        </div>
    
        
    </div>
</template>
  
<script setup>
import { useStore } from 'vuex';
import addIcon from '../../../public/assets/icons/add-to-cart.svg';
import minusIcon from '../../../public/assets/icons/minus.svg';
import { computed } from "vue";
  
const store = useStore();

const cart = computed(() => { 
    return store.getters['cart/cart'];
}); 

const totalCost = computed(() => { 
    return cart.value.reduce((accumulator, item) => accumulator + item.product.cost * item.quantity, 0);
}); 

async function deleteFromCart(cartItem) {
    store.dispatch('cart/deleteFromCart', cartItem);
};

async function addToCart(product) {
    store.dispatch('cart/addToCart', product);
}


</script>
  
<style lang="scss">
.st-cart {
    display: flex;
    align-content: center;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    height: 100%;

    &__page-header {
        display: flex;
        justify-content: center;

        font-size: $--st-font-large;
        font-weight: 700;
        height: 3rem;
        margin-bottom: $--st-offset-xl;

        .st-label {
            margin: 0 3rem;
        }
     
    }

    &__content {
        flex: 1;
        /*ie10*/
        -ms-flex: 1 1 auto; /*needs both shrink and grow*/
    }

    &__grid {
        display: grid;
        align-content: center;
        align-items: center;
        grid-template-columns: repeat(3, min-content);
        gap: $--st-offset-xl;

        .st-label {
            width: max-content;
        }
    }

    &__header{
        font-weight: 700;
    }

    &__counter {
        display: flex;
        align-content: center;
        justify-content: center;
    }

    &__counter-item {
        margin: auto;
        width: min-content;
        height: 16px;

        .st-label {
            margin: 0;
        }
    }

    &__icon {
        cursor: pointer;
        fill: black;
    }

    &__total {
        display: flex;
        font-weight: 700;
        font-size: $--st-font-medium;
        margin: $--st-offset-xl 0;

        align-content: center;
        justify-content: space-between;

        .st-label {
            margin: auto 0;
        }
    }
}
</style>
  