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
    <div v-if="product?.discount > 0" class="st-product-card__with-discount"> 
      <st-label :value="product.cost - product.discount" class="st-product-card__new-cost" />
      <st-label :value="product.cost" class="st-product-card__old-cost"/>
      <rubleIcon />
    </div>
    <div v-else>
      <st-label :value="product.cost" class="st-product-card__new-cost" />
      <rubleIcon />
    </div>
  </div>
</template>

<script setup>
import StLabel from "./st-label.vue";
import {ref} from "vue";
import addToCartIcon from '../../../../public/assets/icons/add-to-cart.svg';
import rubleIcon from '../../../../public/assets/icons/ruble.svg';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const router = useRouter();
let isHover = ref(false);
const props = defineProps({
    product: Object,
});

async function addToCart(product) {
    store.dispatch('cart/addToCart', product);
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

  &__with-discount {
    display: flex;
    align-items: center;
  }

  &__new-cost {
    font-weight: 700;
  }

  &__old-cost {
    text-decoration: line-through;
  }
}


</style>
