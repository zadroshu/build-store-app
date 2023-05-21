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
  border: 1px solid $--st-brown;
  border-radius: 10px;
  text-decoration: none;
  font-weight: 700;
  color: $--st-brown;
  background: $--st-white;
  box-shadow: 0 0.5rem 0 $--st-hover;

  cursor: pointer;
}

.st-button:hover {
  background: $--st-hover;
  box-shadow: none;
  position: relative;
  top: 5px;
}

.disabled {
  cursor: not-allowed;
}

</style>
