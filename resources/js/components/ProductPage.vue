<template>
    <div class="st-product-page">
      <div class="st-product-page__header">
        <st-label :value="product.name" />
      </div>
      <div class="st-product-page__grid">
        <div class="st-product-page__grid-left">
          <img :src="product.img ?? 'https://via.placeholder.com/250x310/09f/fff.png'">
        </div>
        <div class="st-product-page__grid-right">
          <st-label :value="'Категория: ' + product.category" />
          <div v-if="product.discount > 0" class="st-product-page__cost">
            <st-label :value="'Цена: '" />
            <st-label :value="product.cost" class="st-product-page__cost-line-throuthed" />
            <st-label :value="product.cost - props.product.discount" />
          </div>
          <st-label v-else :value="'Цена: ' + product.cost" />
          <st-label :value="'В наличии: ' + product.in_stock" />
          <st-label :value="'Описание: '" />
          <st-label :value="product.description" />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
  export default {
    props: {
        product: Object,
    },
    
    mounted() {
        console.log(product);
    },
  }
  </script>
  
  <style scoped lang="scss">
  .st-product-page {
    &__header {
      margin: $--st-offset-xs;
      font-size: $--st-font-large;
    }
    &__grid {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: $--st-offset-xs;
    }
    &__cost {
      display: grid;
      grid-template-columns: repeat(3, min-content);
      gap: $--st-offset-xs;
    }
    &__cost-line-throuthed {
      text-decoration: line-through;
    }
    &__grid-right {
      display: grid;
      grid-template-columns: auto;
      gap: $--st-offset-xs;
    }
  }
  </style>
  