<template>
    <div class="st-app">
        <st-header />
        <router-view />
        <st-footer />
    </div>
</template>

<script setup>
import StHeader from './components/primitives/st-header.vue';
import StFooter from './components/primitives/st-footer.vue';
</script>

<script>
import Dataservice from './api/dataservice';

export const dataservice = new Dataservice().dataservice;
</script>

<style lang="scss">
.st-app {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-content: stretch;
    min-height: 100%;
}
</style>