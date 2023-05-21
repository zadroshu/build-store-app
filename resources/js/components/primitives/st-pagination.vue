<template>
  <div class="st st-pagination" v-if="links.length > 3">
    <div class=" st-pagination__wrapper">
      <template v-for="(link, p) in links" :key="p">
        <div v-if="link.url === null" class="st-link" v-html="link.label"></div>
        <div v-else class="st-link" :class="{ '--selected': link.active }" :href="link.url" v-html="link.label" @click="onClick(link)"></div>
      </template>
    </div>
  </div>
</template>

<script>
import { toRaw } from 'vue';
export default {
  props: {
    links: Array,
  },
  emits: ['changePage'],

  methods: {
    onClick(link) {
      this.$emit('changePage', toRaw(link));
    },
  },
}
</script>

<style scoped lang="scss">
.st-pagination {

  &__wrapper {
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    justify-content: center;

    margin-bottom: $--st-offset-xs;
  }
}

.--selected,
.st-link:hover,
.st-link {
  text-decoration: none;
  margin-right: 1rem;
  border: 0.5px solid $--st-gray;
  border-radius: 0.5rem;
  cursor: pointer;

  padding: $--st-offset-m $--st-offset-xl;
  margin-bottom: $--st-offset-xs;
  background-color: $--st-white;
}

.st-link:hover {
  background-color: $--st-brown;
  color: $--st-white;
  transition: .2s;
}

.--selected {
  background-color: $--st-brown;
  color: $--st-white;
  transition: .2s;
}
</style>
