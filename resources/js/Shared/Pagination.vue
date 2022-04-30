<template lang="">
    <div>
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="ml-3"
            :class="{ 'font-weight-bold': link.active }"
        />
    </div>
</template>
<script>
export default {
    props: {
        links: Array,
    },
};
</script>
<style lang=""></style>
