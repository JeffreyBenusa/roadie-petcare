<script setup lang="ts">

defineOptions({
  name: "Common Hero"
})

defineProps({
    title: String,
    subtitle: String,
})
</script>

<template>
  <section class="">
    <div class="py-12 container mx-auto px-8">
      <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
        {{ title }}
      </h1>
      <p class="mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl"> {{ subtitle ?? "Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua."}} </p>
    </div>
  </section>
</template>
