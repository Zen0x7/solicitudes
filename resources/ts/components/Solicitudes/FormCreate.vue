<script lang="ts" setup>
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ArrowPathIcon } from "@heroicons/vue/24/outline";
import { useSolicitudes } from "@/stores/solicitudes";

const solicitudes = useSolicitudes();
</script>

<template>
    <div>
        <TransitionRoot as="template" :show="solicitudes.create_open">
            <Dialog
                class="relative z-10"
                @close="solicitudes.create_open = false"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to=""
                    leave="ease-in duration-200"
                    leave-from=""
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-gray-500/75 transition-opacity dark:bg-gray-900/50"
                    ></div>
                </TransitionChild>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div
                        class="flex min-h-full justify-center p-4 text-center items-center sm:p-0"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to=" translate-y-0 sm:scale-100"
                            leave="ease-in duration-200"
                            leave-from=" translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <DialogPanel
                                class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6 dark:bg-gray-800 dark:outline dark:-outline-offset-1 dark:outline-white/10"
                            >
                                <div>
                                    <div>
                                        <DialogTitle
                                            as="h3"
                                            class="text-base font-light text-gray-900 dark:text-white mb-4 slab text-center"
                                        >
                                            Formulario de Ingreso de Solicitudes
                                        </DialogTitle>

                                        <hr class="border-gray-200 pb-5" />

                                        <form class="md:col-span-2">
                                            <div>
                                                <div class="col-span-full">
                                                    <label
                                                        for="numero_documento"
                                                        class="block text-sm/6 text-gray-900 dark:text-white font-light"
                                                        >Número de
                                                        Documento</label
                                                    >
                                                    <div class="mt-2">
                                                        <input
                                                            id="numero_documento"
                                                            v-model="
                                                                solicitudes
                                                                    .create_form
                                                                    .numero_documento
                                                            "
                                                            type="text"
                                                            name="numero_documento"
                                                            autocomplete="numero_documento"
                                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-emerald-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-emerald-500"
                                                            :class="
                                                                solicitudes.create_form.invalid(
                                                                    'numero_documento',
                                                                )
                                                                    ? 'text-red-900 outline-red-300 placeholder:text-red-300 focus:outline-red-600'
                                                                    : ''
                                                            "
                                                            @change="
                                                                solicitudes.create_form.validate(
                                                                    'numero_documento',
                                                                )
                                                            "
                                                        />
                                                        <div
                                                            v-if="
                                                                solicitudes.create_form.invalid(
                                                                    'numero_documento',
                                                                )
                                                            "
                                                            class="mt-2 text-sm text-red-600 dark:text-red-400 font-light"
                                                        >
                                                            {{
                                                                solicitudes
                                                                    .create_form
                                                                    .errors
                                                                    .numero_documento
                                                            }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3"
                                >
                                    <button
                                        id="create_confirmation_button"
                                        type="button"
                                        :disabled="solicitudes.create_loading"
                                        class="cursor-pointer inline-flex w-full justify-center rounded-md bg-emerald-600 px-4 py-3 text-sm font-light slab text-white shadow-xs hover:bg-emerald-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 sm:col-start-2 dark:bg-emerald-500 dark:shadow-none dark:hover:bg-emerald-400 dark:focus-visible:outline-emerald-500"
                                        @click="solicitudes.create_submit()"
                                    >
                                        <ArrowPathIcon
                                            v-if="solicitudes.create_loading"
                                            class="h-4 animate-spin inline-block mt-0.5"
                                        />
                                        <span v-else> Confirmar </span>
                                    </button>
                                    <button
                                        id="create_cancel_button"
                                        type="button"
                                        class="cursor-pointer mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-3 text-sm font-light slab text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20"
                                        @click="solicitudes.create_clear()"
                                    >
                                        Cancelar
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>
