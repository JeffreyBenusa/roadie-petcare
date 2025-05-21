<script setup lang="ts">

import {usePage} from "@inertiajs/vue3";
import { type SharedData, type User } from '@/types';

const page = usePage<SharedData>();

// Define props and destructure the `user` object
const props = defineProps<{
    user: User;
}>();

</script>

<template>
    <div :key="user.email" class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">
        <div class="flex min-w-0 gap-x-4">
            <img class="size-12 flex-none rounded-full bg-gray-50" src="https://picsum.photos/96" alt="`${user.name} Avatar`" />
            <div class="min-w-0 flex-auto">
                <p class="text-sm/6 font-semibold text-gray-900">
                    {{ user.name }}
                </p>
                <p class="mt-1 flex text-xs/5 text-gray-500">
                    <span class="relative truncate hover:underline">{{ user.email }}</span>
                </p>
                <Link :href="`/users/${props.user.id}/`" class="text-sm/6 text-indigo-600 hover:underline">View</Link>
            </div>
        </div>
        <div class="flex flex-col items-end shrink-0 items-center gap-x-4">
            <p class="text-sm/6 text-gray-900">{{ user.email_verified_at ? 'Verified' : 'Unverified' }}</p>
            <Link v-if="page.props.auth.user" :href="`/users/${props.user.id}/edit`" class="text-sm/6 text-indigo-600 hover:underline">Edit</Link>
        </div>
    </div>
</template>
