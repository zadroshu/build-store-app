<template>
    <div class="st-index">
        <div class="st-index__toolbar">
            <st-search @select="goToProduct" />
            <st-combobox :values="categoryComboboxData" @select="sortProductsByCategory" />
            <st-combobox :values="sortComboboxData" :defaultValue="defailtCostValue" @select="sortProductsByCost" />
        </div>
        <st-load v-if="isLoading" />
        <div class="st-index__content" v-else>
            <st-product-list :products="products.data" />
            <st-pagination :links="products.links" @change-page="changePage" />
        </div>
    </div>
  </template>
  <script>
  import StPagination from "./primitives/st-pagination.vue";
  import StProductList from "./primitives//st-product-list.vue";
  import { toRaw } from 'vue';
  import axios from 'axios';
  import { dataservice } from '../App.vue';
  import StSearch from './primitives/st-search.vue';
  
  export default {
    components: {
        StPagination,
        StProductList,
        StSearch,
    },
    
    data() {
        return {
            products: {
                data: [],
                links: [],
            },
            categoryComboboxData: [{id: -1, displayName: 'Все'}],
            sortComboboxData: [
                {id: -1, displayName: 'Без сортировки'},
                {id: 0, displayName: 'По убыванию цены'},
                {id: 1, displayName: 'По возрастанию цены'},
            ],
            defailtCostValue: {id: -1, displayName: 'Без сортировки'},
            selectedCategorySearchId: -1,
            selectedCostSortId: -1,
            isLoading: true,
        }
    },

    methods: {
        async getData() {
            this.isLoading = true;
            const response = await dataservice.products.get();
            this.isLoading = false;

            return response;
        },

        async getCategories() {
            this.isLoading = true;
            const response = await dataservice.categories.get();
            this.isLoading = false;

            return response;
        },

        setComboboxData(data) {
            data.forEach(item => this.categoryComboboxData.push({ id: item.id, displayName: item.name }));
        },

        setData(response) {
            this.products.data = response.data.data;
            this.products.links = response.data.links;
        },

        async sortProductsByCategory(event) {
            this.selectedCategorySearchId = event.id;
            await this.sortProducts()
        },

        async sortProductsByCost(event) {
            this.selectedCostSortId = event.id;
            await this.sortProducts()
        },

        async sortProducts() {
            let response = await dataservice.products.sortProducts(this.selectedCategorySearchId, this.selectedCostSortId);
            this.setData(response);
        },
        
        async changePage(link) {
            this.isLoading = true;
            const response = await axios.get(link.url);
            this.setData(response);
            this.isLoading = false;
        },

        goToProduct(item) {
            this.$router.push({ name: 'product', params: { id: item.id } });
        }
    },

    async mounted() {
        const dataResponse = toRaw(await this.getData());
        this.setData(dataResponse);

        this.setComboboxData(toRaw(await this.getCategories()).data);
    }
    
  }
  </script>

  <style lang="scss">
  .st-index {
    height: 100%;
    &__toolbar {
        display: flex;
        justify-content: space-between;
        margin: 0 $--st-offset-xxl;

        @include breakpoint(md) {
           flex-direction: column;
           max-width: max-content;
           margin: 0 auto;
        }
    }
    &__multiselect {
        max-width: 30%;
    }
    &__content {
        height: 100%;
    }
  }
  </style>
  