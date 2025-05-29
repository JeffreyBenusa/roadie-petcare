<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { type BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/vue3";
import Heading from "@/components/Heading.vue";
import ListingForm from "@/pages/admin/listings/partials/form.vue";

defineOptions({
    name: "Create Listing",
    components: {
        ListingForm
    }
})

const props = defineProps({
    services: Array, // Service types passed from the backend as a prop
});


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Dashboard",
        href: "/admin",
    },
    {
        title: "Listings",
        href: "/admin/listings",
    },
    {
        title: "Create",
        href: "/admin/listings/create",
    },
];

</script>

<template>
    <Head title="Create Listing" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <!-- Form Header -->
            <div class="flex w-full items-center justify-between">
                <Heading title="Create Listing" class="mb-4" />
            </div>
            <ListingForm :services="props.services" button-text="Create Listing"></ListingForm>
        </div>
    </AppLayout>
</template>
