<template>
    <Head>
        <title>User Index</title>
        <meta name="description" content="User Tag Index" head-key="description">
    </Head>
    <Hero title="User" subtitle="Lots of users here"></Hero>

    <div>
        <div class="mt-8 mb-12 mx-auto max-w-xl flex items-center">
            <label for="search" class="block text-sm/6 font-medium text-gray-900 mr-4">Search</label>
            <div class="mt-1">
                <input v-model="search" class="border rounded px-4 py-2 text-sm/6"
                       name="search" id="search"/>
            </div>
        </div>

        <section class="container mx-auto max-w-xl">
            <div class="grid gap-4">
                <User v-for="user in users.data" :key="user.id" :user=user
                      class="rounded-sm border-2 border-gray-200 bg-gray-100 p-4"></User>
            </div>
        </section>
        <section class="my-12 container mx-auto max-w-xl flex justify-center">
            <Pagination :links="users.links"></Pagination>
        </section>
    </div>
</template>

<script setup lang="ts">

import Hero from "@/shared/hero/common.vue"
import User from "@/pages/users/component/User.vue";
import Pagination from "@/shared/Pagination.vue";
import debounce from "lodash/debounce";
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";

defineOptions({
    name: "Users",
    components: {Hero, User},
})
const props = defineProps({
    users: Object,
    filters: Object
})

const search = ref(props.filters?.search)

watch(search, debounce((query) => {
    console.log(query);
    router.get('/users', {search: query}, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    })
},500));

</script>
