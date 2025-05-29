<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';

const props = defineProps({
    services: Array,
    selectedServiceIds: Array,
});

const form = useForm({
    service_ids: [...props.selectedServiceIds],
});

function toggleService(id) {
    const index = form.service_ids.indexOf(id);
    if (index > -1) {
        form.service_ids.splice(index, 1);
    } else {
        form.service_ids.push(id);
    }
}
</script>

<template>
    <Head title="Your Available Services" />
    <AppLayout>
        <div class="p-4">
            <Heading title="Select Your Services" />

            <form @submit.prevent="form.post('/admin/availability/services')">
                <div class="grid grid-cols-1 gap-2">
                    <label v-for="service in props.services" :key="service.id" class="flex items-center gap-2">
                        <input
                                type="checkbox"
                                :value="service.id"
                                :checked="form.service_ids.includes(service.id)"
                                @change="toggleService(service.id)"
                        />
                        <span>{{ service.name }}</span>
                    </label>
                </div>

                <button type="submit" class="mt-4 btn btn-primary">Save</button>
            </form>
        </div>
    </AppLayout>
</template>