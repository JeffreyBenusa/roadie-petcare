<script setup lang="ts">

defineOptions({
    name: 'Hero'
})
defineProps({
    title: String,
    subtitle: String,
    image: String
})
</script>

<template>
    <div class="flex items-center justify-center">
        <div class="container mx-auto flex px-6 py-20">
            <div class="flex-1 flex flex-col items-center justify-center pr-32">
                <h1 class="h1 text-4xl font-bold mb-4">{{$props.title}}</h1>
                <h2 class="h2">{{$props.subtitle}}</h2>
            </div>
            <div class="flex-1">
                <img class="w-full max-w-80" :src="$props.image" alt="">
            </div>
        </div>
    </div>
</template>
