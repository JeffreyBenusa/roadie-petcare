<template>
    <Head>
        <title>{{user.name}} Profile</title>
        <meta name="description" content="Here is the profile page for {{user.name}}" head-key="description">
    </Head>
    <Hero :title=user.name subtitle="Lots of users here"></Hero>
    <section class="container mx-auto max-w-xl">
        <div class="grid gap-4">
            <User v-for="user in users" :key="user.id" :user=user :href="`/users/${user.id}`"
                  class="rounded-sm border-2 border-gray-200 bg-gray-100 p-4"></User>
        </div>
    </section>
</template>

<script setup lang="ts">

import Hero from "@/shared/hero/common.vue"
import User from "@/pages/users/component/User.vue";

defineOptions({
    name: "Users Index",
    components: {Hero},
})
defineProps({
    user: Object,
})
</script>

<style scoped>

</style>
