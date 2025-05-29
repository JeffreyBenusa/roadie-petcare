<script setup lang="ts">
import {reactive} from 'vue'
import {Inertia} from "@inertiajs/inertia";
import {Input} from "@/components/ui/input";

const form = reactive({
    title: '',
    description: ''
});

const submit = () => {
    Inertia.post('/listings', form)
}

</script>

<template>
    <form @submit.prevent="submit" class="px-8 pt-6 pb-8 mb-4 flex flex-col my-2 text-black">
        <div class="col-span-full">
            <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
            <div class="mt-2">
                <Input v-model="form.title" name="title" id="title"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
            </div>
        </div>

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
            <div class="mt-2">
                <textarea v-model="form.description" name="description" id="description" rows="3"
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
            </div>
            <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about yourself.</p>
        </div>
        <div class="mt-12">
            <input type="submit" value="Create Listing" class="px-4 py-2 text-white bg-indigo-600 rounded-md"/>
        </div>
    </form>


</template>
