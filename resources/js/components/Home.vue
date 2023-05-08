<template>
    <st-load v-if="isLoading" />
    <div v-else class="st-index">
        <div class="st-index__toolbar">
            <!-- <multiselect
            class="st-index__multiselect"
            v-model="comboboxValue"
            :options="comboboxOptions"
            @input="selectCategory"
            /> -->
            <st-search />
      </div>
  
  
      <st-product-list :products="products.data" />
      <st-pagination :links="products.links" @change-page="changePage" />
    </div>
  </template>
  <script>
  import StPagination from "./primitives/st-pagination.vue";
  import StProductList from "./primitives//st-product-list.vue";
  import Multiselect from 'vue-multiselect';
  import { toRaw } from 'vue';
  import axios from 'axios';
  import { dataservice } from '../App.vue';
  import StSearch from './primitives/st-search.vue';
  
  export default {
    components: {
        StPagination,
        StProductList,
        Multiselect,
        StSearch,
    },
    
    data() {
        return {
            products: {
                data: [],
                links: [],
            },
            comboboxOptions: [],
            comboboxValue: -1,
            isLoading: true,
        }
    },

    methods: {
        async getComboboxOptions() {
            let categoriesCombobox = [{value: -1,label: 'не выбрано'}];
            return categoriesCombobox;
        },

        async selectCategory(input) {
            if (input){
                await axios.get(`products/search-by-category/${input}`);
            } else {
                await axios.get('/');
            }
        },

        async getData() {
            this.isLoading = true;
            const response = dataservice.products.get();
            this.isLoading = false;

            return response;
        },

        setData(response) {
            this.products.data = response.data.data;
            this.products.links = response.data.links;
        },
        
        async changePage(link) {
            this.isLoading = true;
            const response = await axios.get(link.url);
            this.setData(response);
            isLoading = false;
        }
    },

    async mounted() {
        const response = toRaw(await this.getData());
        this.setData(response);

    }
    
  }
  </script>

  <style lang="scss">
  .st-index {
    &__toolbar {
      display: flex;
    }
    &__multiselect {
      max-width: 30%;
    }
  }
  </style>
  