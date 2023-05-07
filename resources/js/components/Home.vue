<template>
    <div class="st-index">
      <div class="st-index__toolbar">
        toolbar
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
    <!-- placeholder="Поиск..."
    aria-label="Поиск по товарам"
    :get-result-value="getResultValue"
    :debounce-time="100"
    resultListLabel = "aria-label"
    @submit="onSubmit" -->
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
        }
    },

    methods: {
        async search(input) {
            const response = await dataservice.products.getByName(input);
            console.log(response);
            // return response.data;
            return [{id: 9999, name: 'test'}, {id: 99929, name: 'test2'}];
        },

        getResultValue(result) {
            console.log(result);
            // return toRaw(result).name;
            return {id: 9999, name: 'test'};
        },

        async onSubmit(product) {
            // this.$router.push(`/product/${product.id}`);
            console.log(product);
        },

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
            return dataservice.products.get();
        },

        setData(response) {
            this.products.data = response.data.data;
            this.products.links = response.data.links;
        },
        
        async changePage(link) {
            const response = await axios.get(link.url);
            this.setData(response);
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
  