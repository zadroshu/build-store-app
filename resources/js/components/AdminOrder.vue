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
                @plus=""
                @edit="isShowEditModal = true, confirmationItem = $event" 
                @delete="deleteItem"
            />
        </div>
        <st-order-update-modal 
            :isShow="isShowEditModal" 
            :item="confirmationItem" 
            header="Заказ" 
            @close="isShowEditModal = false" 
            @closeUpdateOrder="isShowEditModal = false"
            @updateOrder="update"
        />

        <st-order-create-modal 
            :isShow="isShowCreateModal" 
            :item="confirmationItem" 
            header="Заказ" 
            @close="isShowCreateModal = false" 
            @closeCreateOrder="isShowCreateModal = false"
            @createOrder="create"
        />
    </div>
</template>

<script>
import { toRaw, ref, onMounted } from 'vue';
import { dataservice } from '../App.vue';
import StOrderUpdateModal from './primitives/modals/st-order-update-modal.vue';
import StOrderCreateModal from './primitives/modals/st-order-create-modal.vue';

export default {
    components: {
        StOrderUpdateModal,
        StOrderCreateModal,
    },

    data() {
        return {
            isLoading: false,
            tabeldata: [],
            columns: ['id', 'email', 'phone', 'products'],
            isShowEditModal: false,
            isShowCreateModal: false,

            confirmationItem: {
               email: '',
               phone: '',
               products: [],
            },

        };
    },

    methods: {
        async setData() {
            this.isLoading = true;
            this.tabeldata = toRaw(await dataservice.orders.get()).data;
            this.isLoading = false;
        },

        createOrderModal() {
            this.confirmationItem = {
                email: '',
                phone: '',
                products: [],
            },
            this.isShowCreateModal = true;
        },

        async deleteItem(item) {
            await dataservice.order.delete(item.id);
            await this.setData();
        },

        async update(item) {
            await dataservice.order.update(item);
            await this.setData();
            this.isShowEditModal = false;
        },

        async create(item) {
            const order = {
                email: item.email,
                phone: item.phone,
                cart: this.$store.getters['cart/cart'],
            }
            await dataservice.order.create(order);
            this.$store.dispatch('cart/clearCart');
            await this.setData();
            this.isShowCreateModal = false;
        },
    },

    async mounted() {
        await this.setData();
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