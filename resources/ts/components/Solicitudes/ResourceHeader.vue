<script lang="ts" setup>
import { useSolicitudes } from "@/stores/solicitudes";

const solicitudes = useSolicitudes();
</script>

<template>
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2
                class="text-2xl/7 font-light text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white slab"
            >
                Gestor de Solicitudes
            </h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <input
                v-model="solicitudes.search"
                type="text"
                class="border border-gray-300 px-4 focus:border-gray-300 focus-within:border-gray-300 outline-0 rounded font-light text-sm"
                placeholder="Buscador"
                @keyup="solicitudes.fetch()"
            />
            <button
                id="create_button"
                type="button"
                class="cursor-pointer ml-3 inline-flex items-center rounded bg-emerald-600 px-5 py-3 text-sm font-light text-white shadow-xs hover:bg-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 dark:bg-emerald-500 dark:shadow-none dark:hover:bg-emerald-400 dark:focus-visible:outline-emerald-400 slab"
                @click="solicitudes.create_open = true"
            >
                Ingresar Solicitud
            </button>
        </div>
    </div>
</template>
