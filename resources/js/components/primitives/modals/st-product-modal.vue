<template>
    <div v-if="isShow" class="st-product-modal">
      <div class="st-product-modal__wrapper">
        <div class="st-product-modal__container">

            <div class="st-product-modal__header">
                <slot name="st-product-modal__header">
                <st-label :value="header" />
                <closeIcon class="st-product-modal__header-icon-close" @click="$emit('close')" />
                </slot>
            </div>  

            <div class="st-product-modal__body">
                <st-input v-model="product.name" placeholder="Name" type="text" />
                <st-combobox v-model="product.category_id" :values="categoryComboboxData" />
                <st-input v-model="product.cost" placeholder="Cost" type="number" />
                <st-input v-model="product.description" placeholder="Description" type="text" />
                <st-input v-model="product.image" placeholder="Image" type="text" />
                <st-input v-model="product.in_stock" placeholder="In_stock" type="number" />
            </div>

            <div class="st-product-modal__footer">
            <slot name="st-product-modal__footer">
                <st-button class="st-product-modal__footer-btn" value="Нет" @click="$emit('confirmationNo', item)" />
                <st-button class="st-product-modal__footer-btn" value="Да" @click="$emit('confirmationYes', item)" />
            </slot>
          </div>
        </div>
      </div>
    </div>
</template>
<script setup>
import closeIcon from '../../../../../public/assets/icons/close.svg';
import { onMounted } from 'vue';

const emit = defineEmits(['confirmationYes', 'confirmationNo']); 
const props = defineProps({
    isShow: Boolean,
    header: String,
    item: Object | undefined,
    categories: Array,
});

let product = props.item ?? {
    name: '',
    category_id: -1,
    cost: 0,
    description: '',
    image: '',
    in_stock: 0,
};

let categoryComboboxData = props.categories.map((item) => { return { id: item.id, displayName: item.name }});

console.log(categoryComboboxData);

</script>
<style lang="scss">
.st-product-modal {
    display: flex;
    justify-content: center;
    align-items: center;

    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease;

    &__wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    &__container {
        width: 300px;
        margin: 0px auto;
        padding: $--st-offset-m $--st-offset-l;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;

        display: flex;
        flex-direction: column;
    }

    &__input {
        margin-bottom: 1rem;
    }

    &__header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-top: 0;
        font-weight: 700;
    }

    &__header-icon-close {
        cursor: pointer;
    }

    &__header-icon-close:hover {
        background-color: $--st-hover;
    }

    &__body {
        display: flex;
        flex-direction: column;
        flex: 1;
        margin: 20px 0;
        width: min-content;
    }

    &__footer {
        display: flex;
        flex-direction: row-reverse;
    }

    &__footer-btn {
        margin-right: $--st-offset-xs;
    }

    &__default-button {
        float: right;
    }

    &__enter-from, &__leave-to {
        opacity: 0;
    }

    &__enter-active &__container,
    &__leave-active &__container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
}

</style>