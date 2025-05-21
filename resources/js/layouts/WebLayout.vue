<script setup lang="ts">
import type {BreadcrumbItemType} from '@/types';
import Nav from "@/shared/navigation/Nav.vue";
import Footer from"@/shared/globals/Footer.vue"

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <Head>
        <title>Roadies</title>
        <meta name="description" content="Laravel Inertia defaultProps" head-key="description"/>
    </Head>

    <Nav/>
    <slot/>
    <Footer />
</template>
