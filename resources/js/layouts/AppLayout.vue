<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const flash = page.props.flash

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="flash.success" class="mb-4 rounded bg-green-100 p-3 text-green-800 border border-green-300 fixed top-1.5 right-1.5">
            {{ flash.success }}
        </div>
        <slot />
    </AppLayout>
</template>
