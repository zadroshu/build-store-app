<template>
    <div class="st-app__footer">
        <st-label class="st-app__footer-link" value="Admin" @click="goToAdmin" />
    </div>
  </template>
  
  <script setup>
    import { useRouter } from 'vue-router';

    const router = useRouter();

    function goToAdmin() {
        router.push({name: 'admin'});
    }
  </script>
  
  <style lang="scss">
  .st-app {
    &__footer {
        width: 100%;
        height: 7rem;

        background-color: $--st-white;
        margin-top: $--st-offset-xs;

        &-link {
          text-decoration: underline;
          cursor: pointer;
        }
    }
  }
  </style>
  