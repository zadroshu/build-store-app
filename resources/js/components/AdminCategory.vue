<template>
    <div class="st-admin-category">
        <div class="st-admin-category__toolbar">
            <st-button value="Новая категория" @click="createCategoryModal" />
        </div>
        <st-load v-if="isLoading" />
        <div v-else class="st-admin-category__tabel" >
            <st-tabel 
                :heroes="tabeldata" 
                :columns="columns" 
                :options="{ edit: true, delete: true }" 
                @edit="isShowEditModal = true, confirmationItem = $event" 
                @delete="deleteItem" 
            />
        </div>
        <st-pagination :links="categories.links" @change-page="changePage" />
        <st-category-update-modal 
            :isShow="isShowEditModal" 
            :item="confirmationItem" 
            header="Категория" 
            @close="isShowEditModal = false" 
            @closeUpdateCategory="isShowEditModal = false"
            @updateCategory="update"
        />

        <st-category-create-modal 
            :isShow="isShowCreateModal" 
            :item="confirmationItem" 
            header="Категория" 
            @close="isShowCreateModal = false" 
            @closeCreateCategory="isShowCreateModal = false"
            @createCategory="create"
        />
    </div>
</template>

<script>
import { toRaw, ref, onMounted } from 'vue';
import { dataservice } from '../App.vue';
import StCategoryUpdateModal from './primitives/modals/st-category-update-modal.vue';
import StCategoryCreateModal from './primitives/modals/st-category-create-modal.vue';

export default {
    components: {
        StCategoryUpdateModal,
        StCategoryCreateModal,
    },

    data() {
        return {
            isLoading: false,
            categories: {
                data: [],
                links: [],
            },
            tabeldata: [],
            columns: ['id', 'name'],
            isShowEditModal: false,
            isShowCreateModal: false,

            confirmationItem: {
                id: -1,
                name: '',
            },

        };
    },

    methods: {
        async getData() {
            this.isLoading = true;
            const response = await dataservice.categories.get();
            this.isLoading = false;
            return response;
        },

        async setData(response) {
            this.isLoading = true;
            this.categories.data = response.data.data;
            this.categories.links = response.data.links;
            this.tabeldata = response.data.data;
            this.isLoading = false;
        },

        createCategoryModal() {
            this.confirmationItem = {
                name: '',
            },
            this.isShowCreateModal = true;
        },

        async deleteItem(item) {
            await dataservice.category.delete(item.id);
            const response = await this.getData();
            await this.setData(response);
        },

        async update(item) {
            await dataservice.category.update(item);
            const response = await this.getData();
            await this.setData(response);
            this.isShowEditModal = false;
        },

        async create(item) {
            await dataservice.category.create(item);
            const response = await this.getData();
            await this.setData(response);
            this.isShowCreateModal = false;
        },

        async changePage(link) {
            this.isLoading = true;
            const response = await axios.get(link.url);
            this.setData(response);
            this.isLoading = false;
        },
    },

    async mounted() {
        const dataResponse = toRaw(await this.getData());
        this.setData(dataResponse);
    },
    
}

</script>
<style lang="scss">
.st-admin-category {
    
    margin: $--st-offset-l;

    &__toolbar {
        margin: $--st-offset-l;
        display: flex;
        flex-direction: row-reverse;
    }

    &__tabel {
        display: flex;
        justify-content: center;
    }
}
</style>