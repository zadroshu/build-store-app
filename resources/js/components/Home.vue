<template>
    <div class="st-index">
        <div class="st-index__toolbar">
            <st-combobox :values="comboboxData" @select="onComboboxSelect" />
            <st-search />
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
            comboboxData: [{id: -1, displayName: 'Все'}],
            isLoading: true,
        }
    },

    methods: {
        async getData() {
            this.isLoading = true;
            const response = dataservice.products.get();
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
            data.forEach(item => this.comboboxData.push({ id: item.id, displayName: item.name }));
        },

        setData(response) {
            this.products.data = response.data.data;
            this.products.links = response.data.links;
        },

        async onComboboxSelect(item) {
            let response = {};
            if(item.id === -1) {
                response = toRaw(await this.getData());
            } else {
                this.isLoading = true;
                response = toRaw(await dataservice.products.searchByCategory(item.id));
                this.isLoading = false;
            }
            this.setData(response);
        },
        
        async changePage(link) {
            this.isLoading = true;
            const response = await axios.get(link.url);
            this.setData(response);
            this.isLoading = false;
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
    }
    &__multiselect {
      max-width: 30%;
    }
    &__content {
        height: 100%;
    }
  }
  </style>
  