<template>
    <div class="st-index">
      <div class="st-index__toolbar">
        <Multiselect
          class="st-index__multiselect"
          v-model="comboboxValue"
          :options="comboboxOptions"
          @input="selectCategory"
        />
        <autocomplete
        :search="search"
        placeholder="Поиск..."
        aria-label="Поиск по товарам"
        :get-result-value="getResultValue"
        :debounce-time="100"
        resultListLabel = "aria-label"
        @submit="onSubmit"
        >
        </autocomplete>
      </div>
  
  
      <st-product-list :products="products.data"/>
      <st-pagination :links="products.links"/>
    </div>
  </template>
  
  <script setup>
  import StPagination from "./primitives/st-pagination.vue";
  import StProductList from "./primitives//st-product-list.vue";
  import Multiselect from 'vue-multiselect'
  import Autocomplete from '@trevoreyre/autocomplete-vue'
  import {toRaw} from 'vue';
  import axios from 'axios';
  import dataservice from '../App.vue';
  
  const props = defineProps({
    products: Object,
    categories: Object,
  });
  
  const comboboxOptions = getComboboxOptions();
  let comboboxValue = -1;
  
  async function search(input) {
    const results = await axios.get(`products/search-by-name/${input}`);
    return results.data;
  }
  
  function getResultValue(result) {
    return result.name;
  }
  
  async function onSubmit(event) {
    await router.get(`product/${event.id}`);
  }
  
  async function getComboboxOptions() {
    let categoriesCombobox = [{value: -1,label: 'не выбрано'}];
    const products = await dataservice.product.get();
    console.log(products);
    console.log(toRaw(props.categories));
    toRaw(props.categories).map(category => { categoriesCombobox.push({value: category.id,label: category.name}) });
    return categoriesCombobox;
  }
  
  async function selectCategory(input) {
    if (input){
      await axios.get(`products/search-by-category/${input}`);
    } else {
      await axios.get('/');
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
  