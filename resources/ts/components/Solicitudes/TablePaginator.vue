<script lang="ts" setup>
import { useSolicitudes } from "@/stores/solicitudes";

const solicitudes = useSolicitudes();
</script>

<template>
    <nav
        class="flex items-center justify-between border-t border-gray-200 bg-white py-3 px-4 dark:border-white/10 dark:bg-transparent"
        aria-label="Pagination"
    >
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700 dark:text-gray-300 font-light">
                Mostrando
                {{ " " }}
                <span class="font-medium">{{
                    solicitudes.paginator.from
                }}</span>
                {{ " " }}
                a
                {{ " " }}
                <span class="font-medium">{{ solicitudes.paginator.to }}</span>
                {{ " " }}
                de
                {{ " " }}
                <span class="font-medium">{{
                    solicitudes.paginator.total
                }}</span>
                {{ " " }}
                registros
            </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
            <button
                v-if="solicitudes.can_prev"
                type="button"
                class="cursor-pointer relative inline-flex items-center rounded bg-white px-13 py-2 text-xs font-light text-gray-700 inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-gray-200 dark:inset-ring-white/5 dark:hover:bg-white/20 uppercase slab"
                @click="solicitudes.prev()"
            >
                Anterior
            </button>
            <button
                v-if="solicitudes.can_next"
                type="button"
                class="cursor-pointer relative ml-3 inline-flex items-center rounded bg-white px-11 py-2 text-xs font-light text-gray-700 inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-gray-200 dark:inset-ring-white/5 dark:hover:bg-white/20 uppercase slab"
                @click="solicitudes.next()"
            >
                Siguiente
            </button>
        </div>
    </nav>
</template>
