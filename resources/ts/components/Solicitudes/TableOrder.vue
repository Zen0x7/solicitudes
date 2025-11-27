<script lang="ts" setup>
import { useSolicitudes } from "@/stores/solicitudes";
import { ArrowUpIcon, ArrowDownIcon } from "@heroicons/vue/24/outline";

const solicitudes = useSolicitudes();

const props = defineProps<{
    attribute: string;
    field: string;
}>();
</script>

<template>
    <div
        class="inline-block px-3 py-3.5 text-sm font-light text-gray-900 dark:text-white slab"
        @click="solicitudes.order_by(props.attribute)"
    >
        {{ props.field }}
        <span v-if="solicitudes.order_column === props.attribute">
            <ArrowUpIcon
                v-if="solicitudes.order_direction == 'asc'"
                class="h-4 inline-block"
            />
            <ArrowDownIcon v-else class="h-4 inline-block" />
        </span>
    </div>
</template>
