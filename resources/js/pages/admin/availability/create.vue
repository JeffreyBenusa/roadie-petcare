<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { type BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/vue3";
import Heading from "@/components/Heading.vue";
// import ReviewForm from "./partials/form.vue"

defineOptions({
    name: "Create Review",
    components: {
        ReviewForm
    }
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Dashboard",
        href: "/admin   ",
    },
    {
        title: "Reviews",
        href: "/admin/reviews",
    },
    {
        title: "Create",
        href: "/admin/reviews/create",
    },
];

</script>

<template>
    <Head title="Create Review" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <!-- Form Header -->
            <div class="flex w-full items-center justify-between">
                <Heading title="Create Review" description="todo: Listing Lookups field" class="mb-4"></Heading>
            </div>
            <ReviewForm button-text="Create Review"></ReviewForm>
        </div>
    </AppLayout>
</template>
