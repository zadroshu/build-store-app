<template>
    <div class="st-search">
        <div class="st-search__toolbar">
            <st-input type="text" v-model="searchString" placeholder="Поиск..." />
            <searchIcon />
        </div>
        <div v-if="response.length > 0" class="st-search__results">
            <div v-for="item in response" class="st-search__result-item">
                <st-label :value="item.name" />
            </div>
        </div>
    </div>
</template>

<script>
import {ref, watch, toRaw} from 'vue';
import useDebouncedRef from '../../utils/debounce';
import { dataservice } from '../../App.vue';
import searchIcon from '../../../../public/assets/icons/search-icon.svg';

export default {
    setup() {

        let searchString = useDebouncedRef('', 400);
        let response = ref([]);

        async function search(event) {
            return await dataservice.products.getByName(event);
        };

        watch(searchString, async (newSearchString, oldSearchString) => {
            response = toRaw(await search(newSearchString).data);
            console.log(await search(newSearchString));
        })

        return { response, searchString };
    },
}
</script>

<style lang="scss">
.st-search {
    &__toolbar {
        display: flex;
    }

    &__results {
        max-height: 10rem;
        display: grid;
        grid-template-columns: min-content;
        gap: $--st-offset-xs;

        background-color: #fff;
    }
}
</style>