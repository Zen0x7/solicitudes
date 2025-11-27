<script lang="ts" setup>
import { onMounted } from "vue";
import { useSolicitudes } from "@/stores/solicitudes";
import TablePaginator from "@/components/Solicitudes/TablePaginator.vue";
import TableComponent from "@/components/Solicitudes/TableComponent.vue";
import FormCreate from "@/components/Solicitudes/FormCreate.vue";
import ResourceHeader from "@/components/Solicitudes/ResourceHeader.vue";

const solicitudes = useSolicitudes();

onMounted(async () => {
    await solicitudes.fetch();
});
</script>

<template>
    <main>
        <FormCreate />
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div>
                <ResourceHeader />
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                        >
                            <TableComponent />
                            <TablePaginator />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
