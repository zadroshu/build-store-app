<template>
    <div v-if="isShow" class="st-order-modal">
      <div class="st-order-modal__wrapper">
        <div class="st-order-modal__container">

            <div class="st-order-modal__header">
                <slot name="st-order-modal__header">
                <st-label :value="header" />
                <closeIcon class="st-order-modal__header-icon-close" @click="$emit('close')" />
                </slot>
            </div>  

            <div class="st-order-modal__body">
                <st-input v-model="props.item.name" placeholder="Имя" type="text" />
                <st-input v-model="props.item.email" placeholder="Электронная почта" type="email" />
            </div>

            <div class="st-order-modal__footer">
            <slot name="st-order-modal__footer">
                <st-button class="st-order-modal__footer-btn" value="Нет" @click="$emit('closeUpdateAdmin')" />
                <st-button class="st-order-modal__footer-btn" value="Да" :disabled="!props.item.email" @click="$emit('updateAdmin', item)" />
            </slot>
          </div>
        </div>
      </div>
    </div>
</template>
<script setup>
import closeIcon from '../../../../../public/assets/icons/close.svg';

const emit = defineEmits(['close', 'updateAdmin', 'closeUpdateAdmin']); 
const props = defineProps({
    isShow: Boolean,
    header: String,
    item: Object,
});

</script>
<style lang="scss">
.st-order-modal {
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
        width: max-content;
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
        align-items: center;
        flex: 1;
        margin: $--st-offset-l auto;
        width: min-content;

        .st-input {
            margin-top: $--st-offset-l;
        }
    }

    &__tabel-wrapper {
        max-height: 400px;
        overflow: auto;
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