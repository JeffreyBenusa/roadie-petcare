<script setup lang="ts">
import { defineOptions } from 'vue/dist/vue.js';

defineOptions({
    name: 'Custom Button'
})

defineProps({
    class : {
        type: String,
        default: 'px-4 py-2 rounded-md text-sm font-medium bg-primary'
    },
    href: String,
    type: String,
    method: {
        type: String,
        default: 'get'
    },
})
</script>

<template>
    <Link :href="href" :class="$props.class" :method="method">
        <slot />
    </Link>
</template>
