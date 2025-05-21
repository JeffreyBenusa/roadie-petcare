<template>
    <Head>
        <title>Pet Care Services</title>
        <meta name="description" content="Find pet care services in your area" head-key="description">
    </Head>

    <Hero title="Pet Care Services" subtitle="Find trusted pet care providers in your area"></Hero>

    <section class="container mx-auto px-8 mb-24">
        <div class="mb-8">
            <label for="service_type" class="block text-sm/6 font-medium text-gray-900 mb-2">Service Type</label>
            <select v-model="serviceType"
                    class="border rounded pl-2 pr-8 py-2 text-sm/6"
                    name="service_type"
                    id="service_type">
                <option value="">All Services</option>
                <option v-for="type in serviceTypes" :key="type.id" :value="type.id">
                    {{ type.name }}
                </option>
            </select>
        </div>


        <template v-if="jobs.data.length === 0">
            <div class="text-gray-500 py-12 text-lg font-medium">
                No providers or services available for your selected criteria.
            </div>
        </template>
        <template v-else>
            <ul class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 auto-rows-fr">
                <li v-for="job in jobs.data" :key="job.id" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col justify-between h-full">
                        <header class="mb-2">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 flex lg:flex-col items-baseline">
                                {{ job.title }} <span class="text-xs text-gray-500">{{ job.serviceType }}</span>
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">{{ job.body }}</p>
                        </header>
                        <footer>
                            <Link :href="`/jobs/${job.id}`" class="button">View Job</Link>
                        </footer>
                    </div>
                </li>
                <li v-if="jobs.to === jobs.total" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
                    End
                </li>
            </ul>
        </template>
    </section>

    <section v-if="jobs.per_page < jobs.total" class="my-12 container mx-auto max-w-4xl flex justify-center">
        <Pagination :links="jobs.links"></Pagination>
    </section>
</template>

<script setup lang="ts">
import Hero from '@/shared/hero/common.vue';
import Pagination from '@/shared/Pagination.vue';
import { ref, watch, defineProps } from 'vue';
import {router} from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

const props = defineProps({
    jobs: Object,
    filters: Object,
    serviceTypes: Array,
});

const serviceType = ref(props.filters?.service_type || '');

const routerOptions = {
    preserveState: true,
    preserveScroll: true,
    replace: true,
}
watch([serviceType], debounce(([newServiceType]) => {
    const data = newServiceType ? { service_type: newServiceType } : {};
    router.get('/jobs', data, routerOptions );
}, 300));
</script>
