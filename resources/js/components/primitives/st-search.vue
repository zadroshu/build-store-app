<template>
    <div class="st-search">
        <div class="st-search__toolbar">
            <st-input type="text" v-model="searchString" placeholder="Поиск..." />
            <searchIcon />
        </div>
        <div v-if="isResponse && searchString != ''" class="st-search__results">
            <div v-for="item in response" class="st-search__result-item" @click="goToProduct(item)" >
                <st-label :value="item.name" />
            </div>
        </div>
    </div>
</template>

<script setup>
import searchIcon from '../../../../public/assets/icons/search-icon.svg';
</script>

<script>
import { dataservice } from '../../App.vue';
import useDebouncedRef from '../../utils/debounce';

export default {
    data() {
        return {
            searchString: useDebouncedRef('', 500),
            response: [],
        }
    },

    methods: {
        isResponse() {
            return this.response.length > 0;
        },

        async search(event) {
            return await dataservice.products.getByName(event);
        },

        goToProduct(item) {
            this.$router.push({ name: 'product', params: { id: item.id } });
        }
    },

    watch: {
        async searchString(newSearchString, oldSearchString) {
            this.response = (await this.search(newSearchString)).data;
        }
    },
}
</script>

<style lang="scss">
.st-search {
    position: relative;

    &__toolbar {
        display: flex;
        align-items: center;
    }

    &__results {
        max-height: 25rem;
        width: 100%;
        display: grid;
        grid-template-columns: 100%;
        gap: $--st-offset-xs;
        justify-content: center;
        
        padding-left: $--st-offset-xs;
        padding-bottom: $--st-offset-xs;

        position: absolute;
        background-color: #fff;
        margin-top: $--st-offset-xs;
        overflow: auto;
        z-index: 888;
    }

    &__result-item {
        min-width: 1rem;
        cursor: pointer;
    }

    &__result-item:hover {
        background-color: $--st-hover;
    }
}
</style>