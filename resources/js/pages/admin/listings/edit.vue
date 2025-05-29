<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { type BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/vue3";
import Heading from "@/components/Heading.vue";

import ListingForm from "@/pages/admin/listings/partials/form.vue";

const props = defineProps({
    listing: Object,
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

const submit = {
    url: `/admin/listings/${props.listing?.id}`,
    method: "patch"
};

</script>

<template>
    <Head title="Edit Listing" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <!-- Form Header -->
            <div class="flex w-full items-center justify-between">
                <Heading title="Edit Listing" class="mb-4" />
            </div>
            <ListingForm button-text="Update Listing" :listing="props.listing" :services="props.services"
                         :form=submit></ListingForm>
        </div>
    </AppLayout>
</template>
