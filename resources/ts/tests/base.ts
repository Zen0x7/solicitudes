import { mount } from "@vue/test-utils";
import { createPinia } from "pinia";
import AppComponent from "../components/App.vue";
import router from "../router";

export const app = async () => {
    const pinia = createPinia();

    const wrapper = mount(AppComponent, {
        global: {
            plugins: [router, pinia],
        },
    });
    await router.isReady();
    return wrapper;
};
