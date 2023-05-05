<template>
    <div class="st-app__header">
      <div class="st-app__header-toolbar">
        <div class="st-app__header-phone">
          8-961-502-50-40
        </div>
        <div class="st-app__header-logo">
          <mainLogo />
        </div>
        <div class="st-app__header-cart">
          <img src="#"/>
          <div class="st-app__header-cart-counter">1</div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import mainLogo from '../../../../public/assets/icons/logo.svg';
  </script>
  
  <style lang="scss">
  .st-app {
    &__header {
      width: 100%;
      background-color: $--st-white;
      margin-bottom: $--st-offset-xs;
      flex: 0 0 auto;
      &-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: $--st-offset-xs $--st-offset-xl;
    }
    &-cart {
      display: flex;
      align-items: center;
      &-counter {
          width: 2.25rem;
          height: 1.75rem;
          text-align: center;
          border: 1px solid $--st-gray;
          color: $--st-white;
          font-size: $--st-font-small;
          background: $--st-gray;
          border-radius: 50%;
          -moz-border-radius: 50%;
          -webkit-border-radius: 50%;
          -khtml-border-radius: 50%;
      }
    }
  }
}
  </style>
  