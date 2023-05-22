<template>
    <div class="st-input-file">
        <input type="file" :accept="accept" @change="$emit('change', $event)" />
    </div>
</template>
<script>
export default {
    props: {
        accept: {
            type: String,
            default: 'text/xml',
        },
    },
}
</script>
<style lang="scss">
.st-input-file {
    display: flex;
    align-items: center;
    width: min-content;
    border: 1px solid $--st-brown;
    border-radius: 20px;
    padding: $--st-offset-s;

    input {
        font-size: $--st-font-medium;
        font-weight: 700;
        color: $--st-brown;
    }
}
</style>