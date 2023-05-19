<template>
    <div class="st-admin-order">
        <st-admin-header />
        <div class="st-admin-order__toolbar">
            <st-button value="Новый заказ" @click="createOrderModal" />
        </div>
        <st-load v-if="isLoading" />
        <div v-else class="st-admin-order__tabel" >
          
            <st-tabel 
                :heroes="tabeldata" 
                :columns="columns" 
                :options="{ edit: true, delete: true }" 
                @edit="isShowEditModal = true, confirmationItem = $event" 
                @delete="deleteItem" 
            />
        </div>
        <!-- <st-category-update-modal 
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
        /> -->
    </div>
</template>

<script>
import { toRaw, ref, onMounted } from 'vue';
import { dataservice } from '../App.vue';
// import StOrderUpdateModal from './primitives/modals/st-order-update-modal.vue';
// import StOrderCreateModal from './primitives/modals/st-order-create-modal.vue';

export default {
    // components: {
    //     StOrderCreateModal,
    //     StOrderCreateModal,
    // },

    data() {
        return {
            isLoading: false,
            tabeldata: [],
            columns: ['order_id', 'email', 'phone', 'products'],
            isShowEditModal: false,
            isShowCreateModal: false,

            confirmationItem: {
                id: -1,
                name: '',
            },

        };
    },

    methods: {
        async setData() {
            this.isLoading = true;
            this.tabeldata = (await dataservice.orders.get()).data;
            this.isLoading = false;
        },

        createOrderModal() {
            this.confirmationItem = {
                name: '',
            },
            this.isShowCreateModal = true;
        },

        async deleteItem(item) {
            await dataservice.category.delete(item.id);
            await this.setData();
            this.isShowEditModal = false;
        },

        async update(item) {
            await dataservice.category.update(item);
            await this.setData();
            this.isShowEditModal = false;
        },

        async create(item) {
            await dataservice.category.create(item);
            await this.setData();
            this.isShowCreateModal = false;
        },
    },

    async mounted() {
        await this.setData();
        console.log(this.tabeldata);
    },
    
}

</script>
<style lang="scss">
.st-admin-order {
    
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