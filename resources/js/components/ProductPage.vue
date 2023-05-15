<template>
    <st-load v-if="isLoading" />
    <div v-else class="st-product-page">
      <div class="st-product-page__header">
        <st-label :value="product.name" />
      </div>
      <div class="st-product-page__grid">
        <div class="st-product-page__grid-left">
          <img :src="product.img ?? 'https://via.placeholder.com/250x310/09f/fff.png'">
        </div>
        <div class="st-product-page__grid-center">
          <st-label value="Категория:" />
          <st-label :value="category" />
          <st-label value="Цена:" />
          <div v-if="product.discount > 0" class="st-product-page__cost">
            <st-label :value="product.cost" class="st-product-page__cost-line-throuthed" />
            <st-label :value="product.cost - product.discount" />
          </div>
          <st-label v-else :value="product.cost" />
          <st-label value="В наличии:" />
          <st-label :value="product.in_stock" />
          <st-label class="grid-row" :value="'Описание: '" />
          <st-label class="grid-row" :value="product.description" />
        </div>
        <div>
            <st-button value="В корзину" />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { dataservice } from '../App.vue';
  import { toRaw } from 'vue';
  export default {
    
    props: {
        id: Number,
    },

    data() {
        return {
            product: {},
            category: '',
            isLoading: true,
        }
    },

    methods: {
        async setData() {
            this.isLoading = true;
            this.product = (await dataservice.product.get(this.id))?.data[0];
            this.isLoading = false;
        },

        async setCategory() {
            this.isLoading = true;
            this.category = (await dataservice.category.get(toRaw(this.product).category_id)).data[0].name;
            this.isLoading = false;
        },
    },
    
    async mounted() {
        await this.setData();
        await this.setCategory();
    },
  }
  </script>
  
<style scoped lang="scss">
.st-product-page {
    flex-direction: column;

    &__header {
      margin: $--st-offset-xs;
      font-size: $--st-font-large;
      border-bottom: 1px solid $--st-gray;
    }

    &__grid {
        margin-top: $--st-offset-xl;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: $--st-offset-xl;
        height: max-content;
    }

    &__cost {
        display: grid;
        grid-template-columns: repeat(3, min-content);
        gap: $--st-offset-xs;
    }

    &__cost-line-throuthed {
        text-decoration: line-through;
    }

    &__grid-left {
        margin-left: $--st-offset-xxl;
    }
    &__grid-center {
        display: grid;
        grid-template-columns: 1fr 3fr;
    }
}

.grid-row {
    grid-column: 1/-1;
}
</style>
  