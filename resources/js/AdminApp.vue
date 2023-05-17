<template>
    <router-view />
</template>

<!-- <script setup>
</script> -->

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