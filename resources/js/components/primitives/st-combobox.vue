!<template>
    <div class="st-combobox">
        <div class="st-combobox__toolbar">
            <st-input :value="'all'" />
            <popupTriangle class="st-combobox__popup-triangle-icon" />
        </div>
        <div v-if="isPopup" class="st-combobox__popup">
            <div 
                v-for="item in data" 
                class="st-combobox__popup-item" 
                :class="{'--selected': item.id === selectedId}"
                @click="select(item)"
            >
                <st-label :value="item.displayName" />
            </div>
        </div>
    </div>
</template>

<script setup>
import popupTriangle from '../../../../public/assets/icons/popup-triangle.svg';
</script>

<script>
export default {
    data() {
        return {
            data: [],
            selectedId: -1,
        }
    },

    methods: {
        select() {

        },
    },
}
</script>

<style lang="scss">
.st-combobox {
    position: relative;

    &__toolbar {
        display: flex;
        align-items: center;
    }

    &__popup {
        max-height: 25rem;
        width: 100%;
        grid-template-columns: 100%;
        gap: $--st-offset-xs;

        position: absolute;
        background-color: #fff;
        margin-top: $--st-offset-xs;
        overflow: auto;
    }

    &__popup-item {
        padding-left: $--st-offset-xs;
        min-width: 1rem;
        cursor: pointer;
    }

    &__result-item:hover {
        background-color: $--st-input-bg;
    }
}

.--selected {
    background-color: $--st-input-bg;
}
</style>