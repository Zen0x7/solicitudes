<script lang="ts" setup>
import { useSolicitudes } from "@/stores/solicitudes";
import { ISolicitud } from "@/models";
import TableOrder from "@/components/Solicitudes/TableOrder.vue";

const solicitudes = useSolicitudes();

const get_date = (solicitud: ISolicitud) => {
    return new Date(solicitud.fecha_creacion).toLocaleString();
};
</script>

<template>
    <table
        class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15"
    >
        <thead>
            <tr>
                <th scope="col" class="text-left">
                    <TableOrder attribute="id" field="ID" />
                </th>
                <th scope="col" class="text-left">
                    <TableOrder
                        attribute="document_no"
                        field="Número de Documento"
                    />
                </th>
                <th scope="col" class="text-left">
                    <TableOrder attribute="status" field="Estado" />
                </th>
                <th scope="col" class="text-center">
                    <TableOrder
                        attribute="created_at"
                        field="Fecha de Creación"
                    />
                </th>
                <th
                    scope="col"
                    class="px-3 py-3.5 text-sm font-light text-gray-900 dark:text-white slab text-center"
                >
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody
            class="divide-y divide-gray-200 bg-white dark:divide-white/10 dark:bg-gray-900"
        >
            <tr v-for="solicitud in solicitudes.items" :key="solicitud.id">
                <td class="py-5 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-0">
                    <div class="flex items-center h-12">
                        <div class="ml-6">
                            <div
                                class="font-light text-gray-900 dark:text-white"
                            >
                                {{ solicitud.id }}
                            </div>
                        </div>
                    </div>
                </td>
                <td
                    class="px-3 py-5 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400 font-light"
                >
                    <div class="text-gray-900 dark:text-white">
                        {{ solicitud.numero_documento }}
                    </div>
                </td>
                <td
                    class="px-3 py-5 whitespace-nowrap text-gray-500 dark:text-gray-400"
                >
                    <span
                        class="inline-flex items-center rounded uppercase px-3 py-2 text-xs font-light slab"
                        :class="solicitud.estado"
                        >{{ solicitud.estado }}</span
                    >
                </td>
                <td
                    class="px-3 py-5 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400 font-light text-center"
                >
                    {{ get_date(solicitud) }}
                </td>
                <td
                    class="py-5 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap"
                >
                    <div
                        v-if="solicitud.estado === 'pendiente'"
                        class="sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3"
                    >
                        <button
                            type="button"
                            class="cursor-pointer border font-light border-gray-300 text-gray-700 rounded inline-flex w-full items-center justify-center p-2 uppercase text-xs slab"
                            @click="solicitudes.approve(solicitud)"
                        >
                            Aprobar
                        </button>
                        <button
                            ref="cancelButtonRef"
                            type="button"
                            class="cursor-pointer border font-light border-gray-300 text-gray-700 rounded inline-flex w-full items-center justify-center p-2 uppercase text-xs slab"
                            @click="solicitudes.reject(solicitud)"
                        >
                            Rechazar
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
