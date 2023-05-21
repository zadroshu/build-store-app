<template>
    <div class="st-admin-administrators">
        <div class="st-admin-administrators__toolbar">
            <st-button value="Новый администратор" @click="createItemModal" />
        </div>
        <st-load v-if="isLoading" />
        <div class="st-admin-administrators__body" v-else >
            <st-tabel :heroes="admins.data" :columns="columns" :options="{ edit: true, delete: true }" @edit="isShowEditModal = true, confirmationItem = $event" @delete="deleteItem" />
            <st-pagination :links="admins.links" @change-page="changePage" />
            <st-administrator-update-modal 
                :isShow="isShowEditModal" 
                header="Администратор" 
                :item="confirmationItem" 
                @updateAdmin="updateItem" 
                @closeUpdateAdmin="isShowEditModal = false" 
                @close="isShowEditModal = false" 
            />
            <st-administrator-create-modal 
                :isShow="isShowCreateModal" 
                header="Администратор" 
                :item="confirmationItem" 
                @createAdmin="createItem" 
                @closeCreateAdmin="isShowCreateModal = false" 
                @close="isShowCreateModal = false" 
            /> 
        </div>
    </div>
</template>

<script>
import { toRaw, ref } from 'vue';
import StAdministratorCreateModal from './primitives/modals/st-administrator-create-modal.vue';
import StAdministratorUpdateModal from './primitives/modals/st-administrator-update-modal.vue';
import { dataservice } from '../App.vue';

export default {
    components: {
        StAdministratorCreateModal,
        StAdministratorUpdateModal,
    },
    data() {
        return {
            isLoading: ref(false),
            admins: ref({
                data: [],
                links: [],
            }),
            columns: ['id', 'name', 'email'],
            isShowEditModal: false,
            isShowCreateModal: false,
            confirmationItem: {
                id: null,
                name: null,
                email: null,
                password: null,
                passwordConfirmation: null,
            },
        }
    },

    methods: {
        async getData() {
            this.isLoading = true;
            const response = await dataservice.admins.get();
            this.isLoading = false;
            return response;
        },

        setData(response) {
            this.admins.data = response.data.data;
            this.admins.links = response.data.links;
        },

        async changePage(link) {
            this.isLoading = true;
            const response = await axios.get(link.url);
            this.setData(response);
            this.isLoading = false;
        },

        async updateItem(item) {
            await dataservice.admin.update(item);
            const dataResponse = toRaw(await this.getData());
            this.setData(dataResponse);
            this.isShowEditModal = false;
        },

        createItemModal() {
            this.confirmationItem = {
                name: null,
                email: null,
                password: null,
                passwordConfirmation: null,
            },
            this.isShowCreateModal = true;
        },

        async createItem(item) {
            await dataservice.admin.create(item);
            const dataResponse = toRaw(await this.getData());
            this.setData(dataResponse);
            this.isShowCreateModal = false;
        },

        async deleteItem(item) {
            if (item.is_root != 1) {
                await dataservice.admin.delete(item.id);
                const dataResponse = toRaw(await this.getData());
                this.setData(dataResponse);
            } else {
                console.log('Can\'t delete root administrator');
            }
            
        },
    },

    async mounted() {
        const dataResponse = toRaw(await this.getData());
        this.setData(dataResponse);
    },
}

</script>
<style lang="scss">
.st-admin-administrators {
    margin: $--st-offset-l;

    &__toolbar {
        margin: $--st-offset-l;
        display: flex;
        flex-direction: row-reverse;
    }

    &__body {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
}
</style>