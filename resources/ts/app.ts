import { createApp } from "vue";
import { createPinia } from "pinia";

import "../css/app.css";
import router from "./router";

import App from "@/components/App.vue";

const pinia = createPinia();

const app = createApp(App);

app.use(pinia).use(router).mount("#app");
