import { defineStore } from "pinia";
import { Ref, ref, computed } from "vue";
import axios from "axios";
import { IPaginator, ISolicitud } from "@/models";
import { useForm } from "laravel-precognition-vue";
import { toast } from "vue3-toastify";

export const useSolicitudes = defineStore("solicitudes", () => {
    const items: Ref<ISolicitud[]> = ref([]);

    const cancel = ref(new AbortController());
    const loading = ref(false);
    const order_column = ref("created_at");
    const search = ref("");
    const order_direction = ref("desc");
    const create_open = ref(false);
    const create_loading = ref(false);
    const create_form = useForm("post", "/api/solicitudes", {
        numero_documento: "",
    });

    const paginator: Ref<IPaginator> = ref({
        current_page: 1,
        from: 1,
        last_page: 1,
        per_page: 15,
        to: 15,
        total: 50,
    });

    const fetch = async (page: number = 1) => {
        if (loading.value) {
            cancel.value.abort();
        }
        loading.value = true;
        cancel.value = new AbortController();
        let error: Error;
        try {
            const response = await axios.get(
                `/api/solicitudes?page=${page}&order_column=${order_column.value}&order_direction=${order_direction.value}&search=${search.value}`,
                {
                    signal: cancel.value.signal,
                },
            );
            paginator.value = response.data.meta as IPaginator;
            items.value = response.data.data as ISolicitud[];
        } catch (e) {
            if (!axios.isCancel(e)) {
                toast("Error durante la carga de solicitudes", {
                    type: toast.TYPE.ERROR,
                });
                console.error(e);
            }
            error = e;
        } finally {
            if (!axios.isCancel(error)) {
                loading.value = false;
            }
        }
    };

    const order_by = async (order: string) => {
        if (order_column.value == order) {
            if (order_direction.value == "asc") {
                order_direction.value = "desc";
            } else {
                order_direction.value = "asc";
            }
        } else {
            order_column.value = order;
            order_direction.value = "desc";
        }
        await fetch(paginator.value.current_page);
    };

    const prev = async () => {
        await fetch(paginator.value.current_page - 1);
    };

    const next = async () => {
        await fetch(paginator.value.current_page + 1);
    };

    const can_prev = computed(() => paginator.value.current_page > 1);
    const can_next = computed(
        () => paginator.value.current_page < paginator.value.last_page,
    );

    const create_clear = async () => {
        create_form.reset();
        create_open.value = false;
        create_loading.value = false;
    };

    const create_submit = async () => {
        create_loading.value = true;
        try {
            await create_form.submit();
            create_form.reset();
            toast("Solicitud ingresada correctamente", {
                type: toast.TYPE.SUCCESS,
            });
            create_open.value = false;
        } catch (e) {
            toast("Error durante la creación de solicitud", {
                type: toast.TYPE.ERROR,
            });
            console.error(e);
        } finally {
            create_loading.value = false;
            await fetch(paginator.value.current_page);
        }
    };

    const approve = async (solicitud: ISolicitud) => {
        try {
            await axios.put(`/api/solicitudes/${solicitud.id}`, {
                estado: "aprobado",
            });
            toast("Solicitud aprobada exitosamente", {
                type: toast.TYPE.SUCCESS,
            });
        } catch (e) {
            toast("Error durante la aprobación de la solicitud", {
                type: toast.TYPE.ERROR,
            });
            console.error(e);
        } finally {
            await fetch(paginator.value.current_page);
        }
    };

    const reject = async (solicitud: ISolicitud) => {
        try {
            await axios.put(`/api/solicitudes/${solicitud.id}`, {
                estado: "rechazado",
            });
            toast("Solicitud rechazada exitosamente", {
                type: toast.TYPE.SUCCESS,
            });
        } catch (e) {
            toast("Error durante el rechazo de la solicitud", {
                type: toast.TYPE.ERROR,
            });
            console.error(e);
        } finally {
            await fetch(paginator.value.current_page);
        }
    };

    return {
        search,
        create_open,
        create_form,
        create_loading,
        create_clear,
        create_submit,
        paginator,
        items,
        order_column,
        order_direction,
        order_by,
        fetch,
        can_prev,
        prev,
        can_next,
        next,
        approve,
        reject,
    };
});
