!<template>
    <div class="st-combobox">
        <div class="st-combobox__toolbar">
            <st-label :value="selectedItem.displayName" />
            <popupTriangle class="st-combobox__popup-triangle-icon" :class="{'--popup': isPopup}" @click="isPopup = !isPopup;" />
        </div>
        <div v-if="isPopup" class="st-combobox__popup">
            <div 
                v-for="item in values" 
                class="st-combobox__popup-item" 
                :class="{'--selected': item.id === selectedItem.id}"
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
    props: {
        values: {
            type: Array,
            default: [],
        },

        defaultValue: {
            type: Object,
            default: { id: -1, displayName: 'Все категории' },
        },
    },

    data() {
        return {
            selectedItem: this.defaultValue,
            isPopup: false,
        }
    },

    methods: {
        select(item) {
            this.selectedItem = item,
            this.$emit('select', this.selectedItem);
            this.isPopup = false;
        },
    },
}
</script>

<style lang="scss">
.st-combobox {
    position: relative;

    &__toolbar {
        min-width: 15rem;
        display: flex;
        justify-content: space-between;
        align-items: center;

        background-color: transparent;
        padding: 0 $--st-offset-xs;

        border-bottom: 1px solid $--st-black;
    }

    &__popup {
        max-height: 25rem;
        width: 100%;
        display: grid;
        grid-template-columns: 100%;
        gap: $--st-offset-xs;
        justify-content: center;

        padding-left: $--st-offset-xs;
        padding-bottom: $--st-offset-xs;

        position: absolute;
        background-color: #fff;
        margin-top: $--st-offset-xs;
        overflow: auto;
        z-index: 9999;
    }

    &__popup-item {
        padding-left: $--st-offset-xs;
        min-width: 1rem;
        cursor: pointer;
    }

    &__result-item:hover {
        background-color: $--st-hover;
    }

    &__popup-triangle-icon {
        transition: 0.2s;
        cursor: pointer;
    }
}

.--selected {
    background-color: $--st-hover;
}
.--popup {
    transform: rotate(180deg);
}
</style>