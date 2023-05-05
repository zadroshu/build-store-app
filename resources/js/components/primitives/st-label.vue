<template>
  <div class="st-label">
    <span :color="color">{{value}}</span>
  </div>
</template>

<script setup>
const props = defineProps({
  value: String || Number,
  disabled: Boolean,
  color: String,
});
</script>

<style scoped lang="scss">
  .st-label {
    height: 1.4rem;
    width: 100%;

    margin: $--st-offset-xs 0;
  }
  [color = 'gray'].st-label {
    color: $--st-gray;
  }
  [color = 'black'].st-label {
    color: $--st-black;
  }
  [color = 'white'].st-label {
    color: $--st-black;
  }
</style>
