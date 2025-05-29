<template>
    <Head>
        <title>Create Listing</title>
        <meta name="description" content="Create Listing" head-key="description">
        <meta name="robots" content="noindex,nofollow" head-key="create">
    </Head>

    <Hero></Hero>
    <section class="max-w-lg mx-auto">
        <form @submit.prevent="submit" class="px-8 pt-6 pb-8 mb-4 flex flex-col my-2 text-black">
            <div class="col-span-full">
                <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                <div class="mt-2">
                    <input v-model="form.title" name="title" id="title"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                </div>
                <p class="mt-2 text-sm text-red-600" v-if="form.errors.title">{{form.errors.title}}</p>
            </div>

            <div class="col-span-full">
                <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                <div class="mt-2">
                <textarea v-model="form.description" name="description" id="description" rows="3"
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                </div>
                <p class="mt-2 text-sm text-red-600" v-if="form.errors.description">{{form.errors.description}}</p>
            </div>
            <div class="mt-12">
                <input type="submit" value="Create Listing" class="px-4 py-2 text-white bg-indigo-600 rounded-md"/>
            </div>
        </form>
    </section>
</template>

<script setup lang="ts">
import Hero from "@/shared/hero/common.vue"
import {useForm} from "@inertiajs/vue3";

defineOptions({
    name: "Create Listing",
    components: {Hero},
})

const form = useForm({
    title: '',
    description: ''
});

const submit = () => {
    form.submit('post', '/listings', {
        preserveScroll: true,
        onError: params => {
            console.log(params)
        },
        onSuccess: params => {
            console.log(params)
        }
    });
}
</script>
