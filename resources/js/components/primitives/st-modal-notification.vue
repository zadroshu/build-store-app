<template>
    <div v-if="isShow" class="modal-order">
      <div class="modal-order__wrapper">
        <div class="modal-order__container">

          <div class="modal-order__header">
            <slot name="modal-order__header">
              <st-label :value="header" />
              <closeIcon class="modal-order__header-icon-close" @click="$emit('closeNotificationModal')" />
            </slot>
          </div>  

          <div class="modal-order__body">
            <slot name="modal-order__body">
                <st-label :value="msg" />
            </slot>
          </div>

          <div class="modal-order__footer">
            <slot name="modal-order__footer">
              <st-button value="Ok" @click="$emit('closeNotificationModal')" />
            </slot>
          </div>
        </div>
      </div>
    </div>
</template>
<script setup>
import closeIcon from '../../../../public/assets/icons/close.svg';

const emit = defineEmits(['closeNotificationModal']); 
const props = defineProps({
    isShow: Boolean,
    header: String,
    msg: String,
});

</script>
<style lang="scss">
.modal-order {
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
    }

    &__footer {
        display: flex;
        flex-direction: row-reverse;
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