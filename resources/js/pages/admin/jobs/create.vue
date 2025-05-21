<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { type BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/vue3";
import Heading from "@/components/Heading.vue";
import JobForm from "@/pages/admin/jobs/partials/form.vue";

defineOptions({
    name: "Create Job",
    components: {
        JobForm
    }
})

const props = defineProps({
    serviceTypes: Array, // Service types passed from the backend as a prop
});


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Dashboard",
        href: "/admin",
    },
    {
        title: "Jobs",
        href: "/admin/jobs",
    },
    {
        title: "Create",
        href: "/admin/jobs/create",
    },
];

</script>

<template>
    <Head title="Create Job" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <!-- Form Header -->
            <div class="flex w-full items-center justify-between">
                <Heading title="Create Job" class="mb-4" />
            </div>
            <JobForm :service-types="props.serviceTypes" button-text="Create Job"></JobForm>
        </div>
    </AppLayout>
</template>
