<template>
    <Head>
        <title>Listings Index</title>
        <meta name="description" content="Listings Tag Index" head-key="description">
    </Head>

    <Hero title="Pet Care by People Who Get the Gig Life" subtitle="From techs and tour managers to locals who’ve walked the walk — this is where pet lovers and crew life connect. Find pet care without the formalities. Just people who get it."
    :image=heroImageUrl></Hero>

    <section class="container mx-auto px-6 py-12">
        <h2>Reviews</h2>
        <div class="grid grid-cols-3 gap-8">
            <ReviewItem v-for="review in props.reviews" :review=review :key=review.id ></ReviewItem>
        </div>
    </section>
</template>

<script setup lang="ts">

import Hero from "@/shared/hero/homepage.vue"
import heroImageUrl from "@images/homepage-hero.png";

// Review Item Types
import ReviewItem from "@/shared/Review.vue"
import { type Review } from "@/types";

defineOptions({
    name: "Homepage",
    components: {Hero, ReviewItem},
})

const props = defineProps<{
    reviews: Review[];
}>();

</script>
