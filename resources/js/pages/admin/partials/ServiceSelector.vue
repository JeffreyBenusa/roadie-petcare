<script setup lang="ts">
import { ref, watch } from 'vue';

const props = defineProps<{
    availableServices: { id: number; name: string }[],
    selected: number[],
}>();

const emit = defineEmits<{
    (e: 'update:selected', value: number[]): void
}>();

const selectedServices = ref<number[]>([...props.selected]);

watch(selectedServices, (newVal) => {
    emit('update:selected', newVal);
});
</script>

<template>
    <div class="flex flex-col gap-2">
        <label class="font-semibold">Services Offered</label>
        <div class="grid grid-cols-2 gap-2">
            <label
                    v-for="service in availableServices"
                    :key="service.id"
                    class="flex items-center space-x-2"
            >
                <input
                        type="checkbox"
                        :value="service.id"
                        v-model="selectedServices"
                        class="form-checkbox"
                />
                <span>{{ service.name }}</span>
            </label>
        </div>
    </div>
</template>