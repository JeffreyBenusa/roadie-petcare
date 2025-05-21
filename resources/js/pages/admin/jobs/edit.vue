<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { type BreadcrumbItem } from "@/types";
import { Head, useForm } from "@inertiajs/vue3";
import Heading from "@/components/Heading.vue";
import Label from "@/components/ui/label/Label.vue";
import Input from "@/components/ui/input/Input.vue";
import InputError from "@/components/InputError.vue";

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import JobForm from "@/pages/admin/jobs/partials/form.vue";
import ReviewForm from "@/pages/admin/reviews/partials/form.vue";

const props = defineProps({
    job: Object,
    serviceTypes: Array, // Service types passed from the backend as a prop
});

const form = useForm({
    title: props.job?.title || "", // Pre-fill title from job
    body: props.job?.body || "", // Pre-fill body from job
    service_type_id: props.job?.service_type_id || "", // Pre-fill service type ID from job
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

function submit() {
    form.put(`/admin/jobs/${props.job.id}`); // Submit the form
}

</script>

<template>
    <Head title="Edit Job" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <!-- Form Header -->
            <div class="flex w-full items-center justify-between">
                <Heading title="Edit Job" class="mb-4" />
            </div>
            <JobForm button-text="Update Job" :job="props.job" :service-types="props.serviceTypes"></JobForm>
        </div>
    </AppLayout>
</template>
