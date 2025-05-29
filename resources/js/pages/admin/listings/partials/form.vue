<script setup lang="ts">

import { useForm } from "@inertiajs/vue3";

import Input from "@/components/ui/input/Input.vue";
import InputError from "@/components/InputError.vue";
import Label from "@/components/ui/label/Label.vue";

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

const props = defineProps({
    listing: Object,
    services: Array,
    buttonText: String,
    form: {
        type: Object,
        default: () => ({
            url: '/admin/listings',
            method: 'post'
        })
    }
});

const form = useForm({
    title: props.listing?.title || "",
    body: props.listing?.body || "",
    service_id: props.listing?. service_id || "",
});

function submit() {
    form.submit(
        props.form.method,
        props.form.url
    );
}
</script>

<template>
    <!-- Form -->
    <form @submit.prevent="submit" class="space-y-6 max-w-xl">
        <!-- Listing Title -->

        <Label for="title">Listing Title</Label>
        <!-- Custom Label Component -->
        <Input
                id="title"
                v-model="form.title"
                type="text"
                placeholder="Enter listing title"
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
                placeholder="Enter listing description"
                required
        ></textarea>
        <InputError
                v-if="form.errors.body"
                :message="form.errors.body"
        />

        <!-- Service Type -->

        <Label for=" service_id">Service Type</Label>
        <Select v-model="form. service_id">
            <SelectTrigger class="w-[180px]">
                <SelectValue placeholder="Select Service Type" />
            </SelectTrigger>
            <SelectContent>
                <SelectGroup>
                    <SelectItem
                            v-for="service in props.services"
                            :key=service.id
                            :value=service.id
                    >
                        {{ service.name }}
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
        <InputError
                v-if="form.errors. service_id"
                :message="form.errors. service_id"
        />

        <!-- Submit Button -->
        <button
                type="submit"
                class="bg-primary text-primary-foreground rounded-md py-1 px-2 cursor-pointer"
        >
            {{props.buttonText}}
        </button>
    </form>
</template>
