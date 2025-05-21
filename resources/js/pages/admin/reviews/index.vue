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
    reviews: Object,
});

defineOptions({
    name: 'Reviews Index',
    components: {
        Pagination,
    },
});

function goToEdit(reviewId: number) {
    router.get(`/admin/reviews/${reviewId}/edit`);
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin',
    },
    {
        title: 'Reviews',
        href: '/admin/reviews',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex w-full justify-between items-center">
                <h1 class="text-lg font-bold mr-1">Reviews </h1>
                <Link class="bg-primary text-primary-foreground rounded-md py-1 px-2 cursor-pointer"
                      href="/admin/reviews/create">Create Job</Link>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">ID</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Body</TableHead>
                        <TableHead>Review</TableHead>
                        <TableHead>User</TableHead>
                        <TableHead>Job</TableHead>

                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow
                            class="cursor-pointer"
                            role="link"
                            tabindex="0"
                            v-for="review in reviews.data"
                            :key="review.id"
                            @click="goToEdit(review.id)"
                    >
                        <TableCell>{{ review.id }}</TableCell>
                        <TableCell>{{ review.title }}</TableCell>
                        <TableCell class="max-w-lg">{{ review.body }}</TableCell>
                        <TableCell>{{ review.rating }}</TableCell>
                        <TableCell>{{ review.user }}</TableCell>
                        <TableCell>{{ review.job }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <div class="flex justify-center" v-if="reviews.perPage < reviews.total">
                <Pagination :links="reviews.links"></Pagination>
            </div>

        </div>
    </AppLayout>
</template>
