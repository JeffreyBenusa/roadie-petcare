<script setup lang="ts">
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const props = defineProps<{
    initialSelected: string[]
}>();
const selectedDates = ref(props.initialSelected)
const today = new Date()

;</script>

<template>
    <VueDatePicker
            v-model="selectedDates"
            :range=false
            :inline=true
            :week-start="0"
            multi-dates
            :min-date="today"
            :start-date="today"
            :enable-time-picker="false"
            class="rounded-xl border p-4 shadow-sm"
    >

    </VueDatePicker>
</template>
