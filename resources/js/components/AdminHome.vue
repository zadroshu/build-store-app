<template>
    <div class="st-admin-home">
        <div class="st-admin-home__toolbar">
            <input type="file" accept="text/xml" @change="uploadFile"/>
            <st-button value="Новый товар" @click="createItemModal" />
        </div>
        <st-load v-if="isLoading" />
        <div v-else >
            <st-tabel :heroes="tabeldata" :columns="columns" :options="{ edit: true, delete: true }" @edit="isShowEditModal = true, confirmationItem = $event" @delete="deleteItem" />
            <st-pagination :links="products.links" @change-page="changePage" />
            <st-product-update-modal 
                :isShow="isShowEditModal" 
                header="Товар" 
                :item="confirmationItem" 
                :categories="categories"
                @updateProduct="updateItem" 
                @closeUpdateProduct="isShowEditModal = false" 
                @close="isShowEditModal = false" 
            />
            <st-product-create-modal 
                :isShow="isShowCreateModal" 
                header="Товар" 
                :item="confirmationItem" 
                :categories="categories"
                @createProduct="createItem" 
                @closeCreateProduct="isShowCreateModal = false" 
                @close="isShowCreateModal = false" 
            />   
        </div>
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
            columns: ['id', 'category_id', 'cost', 'discount', 'description', 'image', 'in_stock'],
            isShowEditModal: false,
            isShowCreateModal: false,
            categories: [],
            tabeldata: [],
            confirmationItem: {
                id: -1,
                name: '',
                category_id: -1,
                cost: 0,
                discount: 0,
                description: '',
                image: '',
                in_stock: 0,
            },
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
            this.tabeldata = response.data.data;
            this.tabeldata.forEach(item => {
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

        async updateItem(item) {
            if (!Number.isInteger(item.category_id)) {
                item.category_id = this.categories.find(category => category.name === item.category_id).id;
            }
            await dataservice.product.update(item);
            this.isShowEditModal = false;
            const dataResponse = toRaw(await this.getData());
            this.setData(dataResponse);
        },

        createItemModal() {
            this.confirmationItem = {
                name: '',
                category_id: -1,
                cost: 0,
                discount: 0,
                description: '',
                image: '',
                in_stock: 0,
            },
            this.isShowCreateModal = true;
        },

        async createItem(item) {
            console.log(item);
            if (!Number.isInteger(item.category_id)) {
                item.category_id = this.categories.find(category => category.name === item.category_id).id;
            }
            await dataservice.product.create(item);
            this.isShowCreateModal = false;
            const dataResponse = toRaw(await this.getData());
            this.setData(dataResponse);
        },

        async deleteItem(item) {
            await dataservice.product.delete(item.id);
            const dataResponse = toRaw(await this.getData());
            this.setData(dataResponse);
        },

        async uploadFile(item) {
            const formData = new FormData();
            formData.append('file', item.target.files[0]);
            await dataservice.xml.parse(formData);
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

    &__toolbar {
        margin: $--st-offset-l;
        display: flex;
        flex-direction: row-reverse;
    }
}
</style>