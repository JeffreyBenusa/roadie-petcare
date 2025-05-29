<script setup lang="ts">
import { computed, ref, watch } from 'vue'
import { Label, TimeFieldRoot, TimeFieldInput } from 'reka-ui'

const props = defineProps<{
    modelValue: string
    label?: string
    id?: string
}>()

const emit = defineEmits<{
    (e: 'update:modelValue', value: string): void
}>()

const segments = ref<{ part: string; value: string }[]>([])

// Watch for external model updates
watch(
    () => props.modelValue,
    (value) => {
        if (!value) return
        const [hour, minute] = value.split(':')
        segments.value = [
            { part: 'hour', value: hour.padStart(2, '0') },
            { part: 'literal', value: ':' },
            { part: 'minute', value: minute.padStart(2, '0') },
        ]
    },
    { immediate: true }
)

// Convert segments back to time string
const updateValue = () => {
    const hour = segments.value.find(s => s.part === 'hour')?.value || '00'
    const minute = segments.value.find(s => s.part === 'minute')?.value || '00'
    const time = `${hour}:${minute}`
    emit('update:modelValue', time)
}
</script>

<template>
    <div class="flex flex-col gap-2">
        <Label
                v-if="label"
                class="text-sm text-stone-700 dark:text-white"
                :for="id"
        >
            {{ label }}
        </Label>
        <TimeFieldRoot
                :id="id"
                v-slot="{ segments: slotSegments }"
                class="w-32 flex select-none bg-white items-center rounded-lg shadow-sm text-center text-green10 border p-1 data-[invalid]:border-red-500"
        >
            <template
                    v-for="item in slotSegments"
                    :key="item.part"
            >
                <TimeFieldInput
                        v-if="item.part === 'literal'"
                        :part="item.part"
                >
                    {{ item.value }}
                </TimeFieldInput>
                <TimeFieldInput
                        v-else
                        :part="item.part"
                        class="rounded p-0.5 focus:outline-none focus:shadow-[0_0_0_2px] focus:shadow-black data-[placeholder]:text-green9"
                        @change="updateValue"
                >
                    {{ item.value }}
                </TimeFieldInput>
            </template>
        </TimeFieldRoot>
    </div>
</template>
