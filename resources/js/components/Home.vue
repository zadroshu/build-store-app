<template>
    <div class="st-index">
      <div class="st-index__toolbar">
        toolbar
        <!-- <Multiselect
          class="st-index__multiselect"
          v-model="comboboxValue"
          :options="comboboxOptions"
          @input="selectCategory"
        /> -->
        <!-- <autocomplete
        :search="search"
        placeholder="Поиск..."
        aria-label="Поиск по товарам"
        :get-result-value="getResultValue"
        :debounce-time="100"
        resultListLabel = "aria-label"
        @submit="onSubmit"
        >
        </autocomplete> -->
      </div>
  
  
      <st-product-list :products="products.data" />
      <st-pagination :links="products.links" @changePage="changePage(link)" />
    </div>
  </template>
  
  <script>
  import StPagination from "./primitives/st-pagination.vue";
  import StProductList from "./primitives//st-product-list.vue";
  import Multiselect from 'vue-multiselect'
  import Autocomplete from '@trevoreyre/autocomplete-vue'
  import { toRaw, ref } from 'vue';
  import axios from 'axios';
  import { dataservice } from "../App.vue";
  
  export default {
    components: {
        StPagination,
        StProductList,
        Multiselect,
        Autocomplete,
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
            const results = await axios.get(`products/search-by-name/${input}`);
            return results.data;
        },

        getResultValue(result) {
            return result.name;
        },

        async onSubmit(event) {
            await router.get(`product/${event.id}`);
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
        
        async changePage(link) {
            console.log(link);
        }
    },

    async mounted() {
        const response = toRaw(await this.getData());
        this.products.data = response.data.data;
        this.products.links = response.data.links;
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
  