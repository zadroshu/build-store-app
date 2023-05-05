<script setup>
import { computed } from 'vue';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
  props.active
    ? '--selected'
    : ''
);
</script>

<template>
  <div class="st-link" :class="classes">
    <slot/>
  </div>
</template>

<style lang="scss">

.--selected,
.st-link:hover,
.st-link {
  text-decoration: none;
  margin-right: 1rem;
  border: 0.5px solid $--st-gray;
  border-radius: 0.5rem;
  cursor: pointer;

  padding: 1rem 2rem;
  background-color: $--st-white;
}

.st-link:hover {
  background-color: $--st-blue;
  color: $--st-white;
  transition: .2s;
}

.--selected {
  background-color: $--st-blue;
  color: $--st-white;
  transition: .2s;
}
</style>
