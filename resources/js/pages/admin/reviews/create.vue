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

defineProps({
    serviceTypes: Array, // Service types passed from the backend as a prop
});

const form = useForm({
    title: "",
    body: "",
    service_type_id: "",
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

function submit() {
    form.post("/admin/reviews"); // Submit the form
}
</script>

<template>
    <Head title="Create Review" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <!-- Form Header -->
            <div class="flex w-full items-center justify-between">
                <Heading title="Create Review" class="mb-4" />
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="space-y-6 max-w-xl">
                <!-- Review Title -->

                <Label for="title">Review Title</Label>
                <!-- Custom Label Component -->
                <Input
                    id="title"
                    v-model="form.title"
                    type="text"
                    placeholder="Enter review title"
                    required
                />
                <InputError
                    v-if="form.errors.title"
                    :message="form.errors.title"
                />
                <!-- Custom Error Component -->

                <Label for="body">Body</Label>
                <textarea
                    id="body"
                    v-model="form.body"
                    rows="3"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4"
                    placeholder="Enter review description"
                    required
                ></textarea>
                <InputError
                    v-if="form.errors.body"
                    :message="form.errors.body"
                />

                <!-- Submit Button -->
                <button
                        type="submit"
                        class="bg-primary text-primary-foreground rounded-md py-1 px-2 cursor-pointer"
                >
                    Create Review
                </button>
            </form>
        </div>
    </AppLayout>
</template>
