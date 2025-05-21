<script setup lang="ts">
defineProps({
    links: Object,
})
</script>

<template>
    <Component preserve-scroll
            v-for="link in links"
            :key="link.label"
            :is="link.url ? 'Link' : 'span'"
            :href="link.url"
            v-html="link.label"
            :class="[link.url ? '' : 'text-gray-500', link.active ? 'text-red-500' : '', 'mr-2']">
    </Component>

</template>
