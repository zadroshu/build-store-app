<template>
  <div>
    <button class="st st-button" :disabled="props.disabled ?? false" :class="{'disabled': props.disabled}" :type="props.type">
      {{ props.value }}
    </button>
  </div>
</template>

<script setup>
import {ref} from "vue";

const props = defineProps({
  value: ref(''),
  type: ref('button'),
  disabled: Boolean,
})
</script>

<style scoped lang="scss">
.st-button {
  padding: $--st-offset-m $--st-offset-l;
  border: none;
  border-radius: 10px;
  text-decoration: none;
  color: white;
  background: #0B63F6;
  box-shadow: 0 0.5rem 0 #003CC5;

  cursor: pointer;
}

.st-button:hover {
  background: #003CC5;
  box-shadow: none;
  position: relative;
  top: 5px;
}

.disabled {
  cursor: not-allowed;
}

</style>
