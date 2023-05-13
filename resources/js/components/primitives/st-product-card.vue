<template>
  <div class="st-product-card">
    <div class="st-product-card__img-wrapper">
      <div @click="goToProduct(product)">
        <img class="st-product-card__img-wrapper-img" src="https://via.placeholder.com/250x310/09f/fff.png">
      </div>
      <div preserve-scroll class="st-product-card__img-add-to-cart" @click="addToCart(product)">
        <addToCartIcon
          :class="{'st-product-card--hover': isHover}"
          @mouseenter="isHover = true"
          @mouseleave="isHover = false"
        />
      </div>
    </div>

    <st-label :value="product.name" color='white'/>
    <st-label :value="product.cost"/>
  </div>
</template>

<script setup>
import StLabel from "./st-label.vue";
import {ref} from "vue";
import addToCartIcon from '../../../../public/assets/icons/add-to-cart.svg';
import { dataservice } from '../../App.vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import { mapActions } from 'vuex';

const store = useStore();
const router = useRouter();
let isHover = ref(false);
const props = defineProps({
    product: Object,
});

async function addToCart(product) {
  console.log();
    store.dispatch('cart/addToCart', product);
    // console.log(store.getters.productQuantity(product));
}

function goToProduct(item) {
    router.push({ name: 'product', params: { id: item.id } });
}

</script>

<style scoped lang="scss">

.st-product-card {
  &--hover {
    transition: background-color .5s;
    background-color: red;
    border-radius: 50%;
  }

  &__img-wrapper {
    position: relative;
    cursor: pointer;
    border-radius: 1rem;
  }

  &__img-wrapper-img {
    border-radius: 1rem;
  }

  &__img-add-to-cart {
    position: absolute;

    right: 0;
    top: 0;

    padding: $--st-offset-xs;
  }
}


</style>
