<template>
  <div class="st-product-list">
    <st-product-card v-for="product in products" :key="product.id" :product="product" />
  </div>
</template>

<script setup>
import StProductCard from "./st-product-card.vue";

const props = defineProps({
  products: Array,
})
</script>

<style scoped lang="scss">
.st-product-list {
  display: grid;
  grid-template-columns: repeat(3, auto);
  justify-items: center;
  justify-content: center;
  gap: 7rem $--st-offset-xxl;

  padding: 3rem;

  @include breakpoint(lg) {
    grid-template-columns: repeat(2, auto);
    gap: $--st-offset-xxl $--st-offset-xxl;
  }

  @include breakpoint(sm) {
    grid-template-columns: auto;
    gap: $--st-offset-xl;
  }
}
</style>
