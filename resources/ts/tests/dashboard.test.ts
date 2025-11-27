import { describe, it, expect } from "vitest";
import { app } from "./base";

describe("DashboardPage", () => {
    it("ItRenderCreateForm", async () => {
        const instance = await app();
        await instance.vm.$nextTick();
        expect(instance.text()).toContain("Gestor de Solicitudes");
        expect(instance.text()).toContain("505320567");
        expect(instance.text()).toContain("Siguiente");
        expect(instance.text()).toContain("Ingresar Solicitud");
        expect(instance.text()).toContain("ID");

        const create_button = instance.find("#create_button");
        await create_button.trigger("click");
        await instance.vm.$nextTick();
        expect(document.body.textContent).toContain(
            "Formulario de Ingreso de Solicitudes",
        );
    });
});
