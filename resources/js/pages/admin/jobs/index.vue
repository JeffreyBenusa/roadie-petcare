<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from "@inertiajs/vue3";
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'

import Pagination from '@/shared/Pagination.vue'

defineProps({
    jobs: Object,
});

defineOptions({
    name: 'Jobs Index',
    components: {
        Pagination,
    },
});

function goToEdit(jobId: number) {
    router.get(`/admin/jobs/${jobId}/edit`);
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin',
    },
    {
        title: 'Jobs',
        href: '/admin/jobs',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex w-full justify-between items-center">
                <h1 class="text-lg font-bold mr-1">Jobs </h1>
                <Link class="bg-primary text-primary-foreground rounded-md py-1 px-2 cursor-pointer"
                      href="/admin/jobs/create">Create Job</Link>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">ID</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Service Type</TableHead>
                        <TableHead>User</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow
                            class="cursor-pointer"
                            role="link"
                            tabindex="0"
                            v-for="job in jobs.data"
                            :key="job.id"
                            @click="goToEdit(job.id)"
                    >
                        <TableCell>{{ job.id }}</TableCell>
                        <TableCell>{{ job.title }}</TableCell>
                        <TableCell>{{ job.serviceType }}</TableCell>
                        <TableCell>{{ job.user }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <div class="flex justify-center" v-if="jobs.per_page < jobs.total">
                <Pagination :links="jobs.links"></Pagination>
            </div>

        </div>
    </AppLayout>
</template>
