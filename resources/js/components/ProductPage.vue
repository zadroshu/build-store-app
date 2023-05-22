<template>
    <st-load v-if="isLoading" />
    <div v-else class="st-product-page">
        <div class="st-product-page__header">
            <st-label :value="product.name" />
        </div>
        <div class="st-product-page__grid">
            <div class="st-product-page__grid-left">
                <img :src="`/storage/${product.image}`">
            </div>
            <div class="st-product-page__grid-center">
            <st-label value="Категория:" />
            <st-label :value="category" />
            <st-label value="Цена:" />
            <div v-if="product.discount > 0" class="st-product-page__cost">
                <st-label :value="product.cost - product.discount" />
                <st-label :value="product.cost" class="st-product-page__cost-line-throuthed" />
                <rubleIcon />
            </div>
            <st-label v-else :value="product.cost" />
            <st-label value="В наличии:" />
            <st-label :value="product.in_stock" />
            <st-label class="grid-row" :value="'Описание: '" />
            <st-label class="grid-row" :value="product.description" />
        </div>
        <div v-if="isWidth" class="st-product-page__grid-right">
            <div v-if="product?.discount > 0" class="st-product-page__cost">
                <st-label :value="product.cost - product.discount" />
                <st-label :value="product.cost" class="st-product-page__cost-line-throuthed" />
                <rubleIcon />
            </div>
            <st-label v-else :value="product.cost" />
            <div class="st-product-page__sep"></div>
            <st-button value="Добавить в корзину" @click="addToCart" />
        </div>
        <st-button v-else class="st-product-page__btn" value="Добавить в корзину" @click="addToCart" />

      </div>
    </div>
</template>
<script setup>
    import rubleIcon from '../../../public/assets/icons/ruble.svg';
</script>
<script>
import { dataservice } from '../App.vue';
import { toRaw, ref } from 'vue';
export default {
    props: {
        id: Number,
    },

    data() {
        return {
            product: ref({}),
            category: '',
            isLoading: true,
        }
    },

    computed: {
        isWidth() {
            return document.documentElement.clientWidth > 992;
        },
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

        addToCart() {
            this.$store.dispatch('cart/addToCart', this.product);
        }
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
        font-size: $--st-font-big;

        @include breakpoint(lg) {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }

    &__cost {
        display: grid;
        grid-template-columns: repeat(3, min-content);
        align-items: center;
    }

    &__cost-line-throuthed {
        text-decoration: line-through;
    }

    &__grid-left {
        width: 300px;
        border-color: red;
        margin-left: $--st-offset-xxl;

        img {
            width: 300px;
            height: 350px ;
        }
        @include breakpoint(lg) {
            margin-left: 0;
        }
    }

    &__grid-center {
        display: grid;
        height: min-content;
        grid-template-columns: 1fr 3fr;
    }

    &__grid-right {
        width: max-content;
        height: max-content;
        padding: $--st-offset-l;
        border: 1px solid $--st-gray;
        border-radius: 10px;
    }

    &__sep {
        height: $--st-offset-xl;
    }

    &__btn {
        margin-bottom: $--st-offset-l;
    }
}

.grid-row {
    grid-column: 1/-1;
}
</style>
  