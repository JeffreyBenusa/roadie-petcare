<script setup lang="ts">
import { cn } from '@/lib/utils'
import { Popover, PopoverTrigger, PopoverContent } from '@/components/ui/popover'
import { Button } from '@/components/ui/button'
import { computed, ref, watch } from 'vue'

const props = defineProps<{
    modelValue: string
    class?: string
}>()

const emit = defineEmits<{
    (e: 'update:modelValue', value: string): void
}>()

const times = Array.from({ length: 24 }, (_, hour) =>
    ['00', '30'].map(minute => `${String(hour).padStart(2, '0')}:${minute}`)
).flat()

const selected = ref(props.modelValue)

watch(
    () => props.modelValue,
    value => {
        selected.value = value
    }
)

function selectTime(time: string) {
    selected.value = time
    emit('update:modelValue', time)
}
</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <Button
                    variant="outline"
                    :class="cn('w-[120px] justify-start text-left font-normal', props.class)"
            >
                {{ selected || 'Select time' }}
            </Button>
        </PopoverTrigger>
        <PopoverContent class="w-auto p-0 max-h-60 overflow-auto">
            <ul>
                <li
                        v-for="time in times"
                        :key="time"
                        @click="selectTime(time)"
                        class="px-4 py-2 hover:bg-muted cursor-pointer text-sm"
                >
                    {{ time }}
                </li>
            </ul>
        </PopoverContent>
    </Popover>
</template>