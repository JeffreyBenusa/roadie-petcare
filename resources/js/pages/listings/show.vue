<script lang="ts" setup>
import {defineComponent, defineProps} from 'vue'
import Hero from "@/shared/hero/common.vue";

const props = defineProps({
    listing: Object,
    owner: Object,
})

defineComponent({
    name: "show",
    components: {Hero}
})
</script>

<template>
    <Head>
        <title>Listings Index</title>
        <meta name="description" content="Listings Tag Index" head-key="description">
    </Head>

    <Hero title="Listings" subtitle="Lots of pets need a little hlp"></Hero>

    <section class="container mx-auto max-w-xl p-8">
        <h1 class="text-3xl font-bold">
            {{ listing.title }}
        </h1>
        <p class="text-lg/6">
            {{ listing.description }}
        </p>

        <p>{{owner.name}}</p>

    </section>
</template>
