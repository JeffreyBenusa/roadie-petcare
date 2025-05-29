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
    listings: Object,
});

defineOptions({
    name: 'Listings Index',
    components: {
        Pagination,
    },
});

function goToEdit(listingId: number) {
    router.get(`/admin/listings/${listingId}/edit`);
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin',
    },
    {
        title: 'Listings',
        href: '/admin/listings',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex w-full justify-between items-center">
                <h1 class="text-lg font-bold mr-1">Listings </h1>
                <Link class="bg-primary text-primary-foreground rounded-md py-1 px-2 cursor-pointer"
                      href="/admin/listings/create">Create Listing</Link>
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
                            v-for="listing in listings.data"
                            :key="listing.id"
                            @click="goToEdit(listing.id)"
                    >
                        <TableCell>{{ listing.id }}</TableCell>
                        <TableCell>{{ listing.title }}</TableCell>
                        <TableCell>{{ listing.service }}</TableCell>
                        <TableCell>{{ listing.user }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <div class="flex justify-center" v-if="listings.per_page < listings.total">
                <Pagination :links="listings.links"></Pagination>
            </div>

        </div>
    </AppLayout>
</template>
