<script setup lang="ts">
import { ref, watch } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

const props = defineProps({
    users: Array,
    filters: Object,
    serviceTypes: Array,
});

const form = useForm({
    start_date: props.filters?.start_date || '',
    end_date: props.filters?.end_date || '',
    service_type_id: props.filters?.service_type_id || ''
});

// Watch for start_date and auto-fill end_date if empty
watch(() => form.start_date, (newVal) => {
    if (newVal && !form.end_date) {
        form.end_date = newVal;
    }
});

const submitSearch = () => {
    if (!form.end_date && form.start_date) {
        form.end_date = form.start_date;
    }
    form.get('/providers');
};
</script>

<template>
    <Head title="Find Providers" />

    <div class="space-y-6 p-4 container mx-auto">
        <!-- Search Filters -->
        <Card>
            <CardHeader>
                <CardTitle>Search Providers</CardTitle>
                <CardDescription>Search by service and date range</CardDescription>
            </CardHeader>
            <CardContent class="grid gap-4 md:grid-cols-3">
                <div>
                    <label for="service_type">Service Type</label>
                    <Select v-model="form.service_type_id"  class="w-full border rounded p-2 h-[42px]">
                        <SelectTrigger class="w-[180px]">
                            <SelectValue placeholder="Select Service Type" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem
                                        v-for="serviceType in props.serviceTypes"
                                        :key=serviceType.id
                                        :value="String(serviceType.id)"
                                >
                                    {{ serviceType.name }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                </div>
                <div>
                    <label for="start_date">Start Date</label>
                    <input
                            id="start_date"
                            v-model="form.start_date"
                            type="date"
                            class="w-full border rounded p-2"
                    />
                </div>
                <div>
                    <label for="end_date">End Date <span class="text-sm text-gray-500">(optional, will match start date if left blank)</span></label>
                    <input
                            id="end_date"
                            v-model="form.end_date"
                            type="date"
                            class="w-full border rounded p-2"
                            :disabled="!form.start_date"
                    />
                </div>
                <div class="md:col-span-3">
                    <button @click="submitSearch" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">
                        Search
                    </button>
                </div>
            </CardContent>
        </Card>

        <!-- Results -->
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            <Card v-for="user in users" :key="user.id">
                <CardHeader>
                    <CardTitle>{{ user.name }}</CardTitle>
                    <CardDescription>{{ user.email }}</CardDescription>
                </CardHeader>
                <CardContent>
                    <p>User ID: {{ user.id }}</p>
                    <p class="text-sm">More info coming soon...</p>
                </CardContent>
            </Card>
            <Card v-if="users?.length == 0">
                <CardHeader>
                    <CardTitle>No Providers Available</CardTitle>
                </CardHeader>
                <CardContent>
                    <p class="text-sm ">More info coming soon...</p>
                </CardContent>
            </Card>
        </div>
    </div>

</template>
