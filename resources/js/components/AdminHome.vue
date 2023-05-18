<template>
    <st-load v-if="isLoading" />
    <div v-else class="st-admin-home">
        <st-tabel :heroes="products.data" :columns="columns" :options="{ edit: true, delete: true }" @edit="isShowEditModal = true, confirmationItem = $event" @delete="deleteItem" />
        <st-pagination :links="products.links" @change-page="changePage" />
        <st-product-modal 
            :isShow="isShowEditModal" 
            header="Товар" 
            :item="confirmationItem" 
            :categories="categories"
            @confirmationYes="editItem" 
            @confirmationNo="isShowEditModal = false" 
            @close="isShowEditModal = false" 
        />
        
    </div>
</template>

<script>
import { toRaw, ref, onMounted } from 'vue';
import { dataservice } from '../App.vue';

export default {
    data() {
        return {
            isLoading: ref(false),
            products: ref({
                data: [],
                links: [],
            }),
            columns: ['name', 'category_id', 'cost', 'discount', 'description', 'images', 'in_stock'],
            isShowEditModal: false,
            categories: [],
            confirmationItem: {},
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

        setData(response) {
            this.products.data = response.data.data;
            this.products.data.forEach(item => {
                item.category_id = toRaw(this.categories.find(category => category.id === item.category_id))?.name ?? item.category_id;
            });

            this.products.links = response.data.links;
        },

        async changePage(link) {
            this.isLoading = true;
            const response = await axios.get(link.url);
            this.setData(response);
            this.isLoading = false;
        },

        async editItem(item) {
            console.log(item);
            this.isShowEditModal = false;
        },

        async deleteItem(item) {
            await dataservice.product.delete(item.id);
            const dataResponse = toRaw(await this.getData());
            this.setData(dataResponse);
        },
    },

    async mounted() {
        const dataResponse = toRaw(await this.getData());
        this.categories = toRaw(await this.getCategories()).data;
        this.setData(dataResponse);
    },
}

</script>
<style lang="scss">
.st-admin-home {
    margin: $--st-offset-l;
}
</style>