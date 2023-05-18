<template>
    <div class="st-tabel">
        <table>
            <thead>
            <tr>
                <th v-for="key in columns"
                @click="$emit('sort', key)">
                    <st-label :value="capitalize(key)" />
                <!-- <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
                </span> -->
                </th>
                <th v-if="options?.edit">
                    <st-label value="Изменить" />
                </th>
                <th v-if="options?.delete">
                    <st-label value="Удалить" />
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="entry in heroes">
                <td v-for="key in columns">
                <st-label :value="entry[key]" />
                </td>
                <td v-if="options?.edit">
                    <div class="st-tabel__icon-wrapper"><editIcon @click="$emit('edit', entry)" /></div>
                </td>
                <td v-if="options?.delete">
                    <div class="st-tabel__icon-wrapper"><deleteIcon @click="confirmationItem = entry, isShowDeleteModal = true" /></div>
                </td>
            </tr>
            </tbody>
        </table>
        <st-confirmation-modal 
            :isShow="isShowDeleteModal" 
            :item="confirmationItem" 
            header="Удаление" 
            msg="Вы действительно хотите удалить товар?" 
            @confirmationYes="$emit('delete', $event), isShowDeleteModal = false" 
            @confirmationNo="isShowDeleteModal = false" 
            @close="isShowDeleteModal = false" 
        />
    </div>
</template>

<script setup>
import editIcon from '../../../../public/assets/icons/edit.svg';
import deleteIcon from '../../../../public/assets/icons/delete-icon.svg';
import { ref } from 'vue';

const props = defineProps({
    heroes: Array,
    columns: Array,
    options: {
        edit: false,
        delete: false,
    },
});

let isShowDeleteModal = ref(false);
let filterKey = 1;

let confirmationItem = ref({});
  
function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
};
</script>


<style lang="scss">
.st-tabel {
    border-radius: 3px;
    background-color: #fff;
    margin: $--st-offset-l;

    th {
        background-color: $--st-blue;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    td {
        background-color: #f9f9f9;
        width: min-content;
    }

    &__icon-wrapper {
        display: flex;
        justify-content: center;

        svg {
            cursor: pointer;
        }
    }
}





th,
th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}
</style>