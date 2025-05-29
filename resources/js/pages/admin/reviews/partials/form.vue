<script setup lang="ts">

import { useForm } from "@inertiajs/vue3";

import Input from "@/components/ui/input/Input.vue";
import InputError from "@/components/InputError.vue";
import Label from "@/components/ui/label/Label.vue";

const props = defineProps({
    review: Object,
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
    title: props.review?.title || "",
    rating: props.review?.rating || "",
    body: props.review?.body || ""
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

    {{ props.form}}
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

        <Label class="flex justify-baseline" for="rating">Rating <span class="text-xs">(1.0 - 5.0)</span></Label>
        <Input
                id="rating"
                v-model="form.rating"
                type="number"
                placeholder="Score 1-5"
                step="0.1"
                min="1"
                max="5"
                required
        />
        <InputError
                v-if="form.errors.rating"
                :message="form.errors.rating"
        />

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
            {{props.buttonText}}
        </button>
    </form>
</template>
