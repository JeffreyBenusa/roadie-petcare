<script setup lang="ts">
import type { CalendarRootProps } from 'reka-ui'
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';

import {
    CalendarRoot,
    CalendarHeader,
    CalendarHeading,
    CalendarPrev,
    CalendarNext,
    CalendarGrid,
    CalendarGridHead,
    CalendarHeadCell,
    CalendarGridBody,
    CalendarGridRow,
    CalendarCell,
    CalendarCellTrigger,
} from "reka-ui";
import { CalendarDate } from "@internationalized/date";
import { ref, watch } from "vue";

const props = defineProps<{
    initialSelected: string[];
    serviceId: number;
}>();

const emit = defineEmits<{
    (
        e: "update",
        payload: { serviceId: number; selectedDates: string[] },
    ): void;
}>();

const selected = ref<Set<string>>(new Set(props.initialSelected));

watch(selected, () => {
    emit("update", {
        serviceId: props.serviceId,
        selectedDates: Array.from(selected.value),
    });
});
</script>

<template>
    <CalendarRoot
        multiple
        v-slot="{ weekDays, grid }"
        :selected="Array.from(selected)"
        @update:selected="(dates) => (selected.value = new Set(dates))"
        class="rounded-xl border p-4 shadow-sm"
    >
        <CalendarHeader class="flex justify-between items-center mb-2">
            <CalendarPrev
                class="hover:bg-stone-100 w-8 h-8 flex items-center justify-center rounded"
            >
                <Icon icon="radix-icons:chevron-left" />
            </CalendarPrev>
            <CalendarHeading class="font-semibold text-sm" />
            <CalendarNext
                class="hover:bg-stone-100 w-8 h-8 flex items-center justify-center rounded"
            >
                <Icon icon="radix-icons:chevron-right" />
            </CalendarNext>
        </CalendarHeader>

        <CalendarGrid
            v-for="month in grid"
            :key="month.value.toString()"
            class="grid space-y-1"
        >
            <CalendarGridHead>
                <CalendarGridRow class="grid grid-cols-7 text-xs font-medium">
                    <CalendarHeadCell
                        v-for="day in weekDays"
                        :key="day"
                        class="text-green8"
                    >
                        {{ day }}
                    </CalendarHeadCell>
                </CalendarGridRow>
            </CalendarGridHead>
            <CalendarGridBody>
                <CalendarGridRow
                    v-for="(weekDates, i) in month.rows"
                    :key="`week-${i}`"
                    class="grid grid-cols-7"
                >
                    <CalendarCell
                        v-for="date in weekDates"
                        :key="date.toString()"
                        :date="date"
                    >
                        <CalendarCellTrigger
                            :day="date"
                            :month="month.value"
                            class="w-8 h-8 rounded-full text-sm text-center hover:bg-green5 data-[selected]:bg-green10 data-[selected]:text-white"
                        />
                    </CalendarCell>
                </CalendarGridRow>
            </CalendarGridBody>
        </CalendarGrid>
    </CalendarRoot>
</template>
