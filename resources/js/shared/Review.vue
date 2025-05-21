<script setup lang="ts">

import {type Review} from '@/types';

defineOptions({
    name: "Review Item"
})

const props = defineProps<{
    review: Review
}>()

</script>

<template>
    <div class="">
        <header class="flex">
            <img src="" alt="">
            <div>
                <p>{{props.review.name}}</p>
                <p>{{props.review.rating}}</p>
            </div>
        </header>
        <p>
            {{props.review.body}}
        </p>
    </div>

</template>
