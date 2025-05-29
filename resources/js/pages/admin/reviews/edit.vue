<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { type BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/vue3";
import Heading from "@/components/Heading.vue";

import ReviewForm from "@/pages/admin/reviews/partials/form.vue";

const props = defineProps({
    review: Object,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Dashboard",
        href: "/admin",
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

const submit = {
    url: `/admin/reviews/${props.review?.id}`,
    method: "patch"
};

</script>

<template>
    <Head title="Edit Review" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <!-- Form Header -->
            <div class="flex w-full items-center justify-between">
                <Heading title="Edit Review" class="mb-4" />
            </div>

            <ReviewForm button-text="Update Review" :review="props.review" :form=submit></ReviewForm>
        </div>
    </AppLayout>
</template>
