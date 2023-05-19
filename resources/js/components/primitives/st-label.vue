<template>
  <div class="st-label">
    <span :bold="bold ? bold : false" :color="color">{{value}}</span>
  </div>
</template>

<script setup>
const props = defineProps({
  value: String | Number,
  disabled: Boolean | undefined,
  color: String | undefined,
  bold: Boolean | undefined,
});
</script>

<style scoped lang="scss">
  .st-label {
    margin: $--st-offset-xs $--st-offset-m;
    
  }
  [color = 'gray'].st-label {
    color: $--st-gray;
  }
  [color = 'black'].st-label {
    color: $--st-black;
  }
  [color = 'white'].st-label {
    color: $--st-white;
  }

  [bold = 'true'].st-label {
    font-weight: 700;
  }
</style>
