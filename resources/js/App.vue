<template>
    <div class="st-app">
        <st-header v-if="!this.$route.path.includes('admin')"/>
        <st-admin-header v-else />
        <div class="st-app__content">
            <router-view />
        </div>
        <st-footer />
    </div>
</template>

<script setup>
import StHeader from './components/primitives/st-header.vue';
import StFooter from './components/primitives/st-footer.vue';
import { onMounted } from 'vue';
import { useStore } from 'vuex';


const store = useStore();
onMounted(() => {
    store.commit('cart/updateCartFromLocalStorage');
})
</script>

<script>
import Dataservice from './api/dataservice';
export const dataservice = new Dataservice().dataservice;
</script>

<style lang="scss">
.st-app {
    height: 100vh; /* for shorter content */
    display: flex;
    flex-direction: column;

    display: -ms-flexbox;
    -ms-flex-direction: column;

    &__content {
        flex: 1;
        /*ie10*/
        -ms-flex: 1 1 auto; /*needs both shrink and grow*/
    }
}
</style>