<template lang="">
    <div class="pagination">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in links"
                :href="link.url"
                v-html="link.label"
                class="ml-3 page-item"
                :class="{ 'activeLink': link.active }"
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
<style>

.activeLink{
    background: rgb(255, 174, 0);
    padding: 2px 7px 2px 7px;
}
</style>
