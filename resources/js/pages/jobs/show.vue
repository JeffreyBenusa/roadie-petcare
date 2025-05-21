<script lang="ts" setup>
import {defineComponent, defineProps} from 'vue'
import Hero from "@/shared/hero/common.vue";

const props = defineProps({
    job: Object,
    owner: Object,
})

defineComponent({
    name: "show",
    components: {Hero}
})
</script>

<template>
    <Head>
        <title>Jobs Index</title>
        <meta name="description" content="Jobs Tag Index" head-key="description">
    </Head>

    <Hero title="Jobs" subtitle="Lots of pets need a little hlp"></Hero>

    <section class="container mx-auto max-w-xl p-8">
        <h1 class="text-3xl font-bold">
            {{ job.title }}
        </h1>
        <p class="text-lg/6">
            {{ job.description }}
        </p>

        <p>{{owner.name}}</p>

    </section>
</template>
