<template>
  <div class="st-product-card">
    <div class="st-product-card__img-wrapper">
      <div >
        <img class="st-product-card__img-wrapper-img" src="https://via.placeholder.com/250x310/09f/fff.png">
      </div>
      <div preserve-scroll class="st-product-card__img-add-to-cart" @click="addToCart(product.id)">
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
import axios from "axios";

const props = defineProps({
  product: Object,
})
let isHover = ref(false);

async function addToCart(id) {
  await axios.get(`product/add-to-cart/${id}`);
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
