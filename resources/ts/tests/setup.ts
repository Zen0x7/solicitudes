/* eslint-disable @typescript-eslint/no-require-imports */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { vi } from "vitest";
import { config } from "@vue/test-utils";

const get_solicitudes = {
    message: "Solicitudes obtenidas correctamente",
    data: [
        {
            id: 17,
            numero_documento: "505320567",
            estado: "aprobado",
            fecha_creacion: "2025-11-27T04:29:22.000000Z",
        },
        {
            id: 25,
            numero_documento: "597253650",
            estado: "rechazado",
            fecha_creacion: "2025-11-27T04:29:22.000000Z",
        },
        {
            id: 45,
            numero_documento: "472943542",
            estado: "rechazado",
            fecha_creacion: "2025-11-27T04:29:22.000000Z",
        },
        {
            id: 5,
            numero_documento: "330329384",
            estado: "rechazado",
            fecha_creacion: "2025-11-27T03:29:22.000000Z",
        },
        {
            id: 21,
            numero_documento: "629850914",
            estado: "pendiente",
            fecha_creacion: "2025-11-27T02:29:22.000000Z",
        },
        {
            id: 7,
            numero_documento: "937018692",
            estado: "aprobado",
            fecha_creacion: "2025-11-26T19:29:22.000000Z",
        },
        {
            id: 30,
            numero_documento: "543606085",
            estado: "pendiente",
            fecha_creacion: "2025-11-26T18:29:22.000000Z",
        },
        {
            id: 39,
            numero_documento: "453388833",
            estado: "aprobado",
            fecha_creacion: "2025-11-26T16:29:22.000000Z",
        },
        {
            id: 42,
            numero_documento: "278757900",
            estado: "rechazado",
            fecha_creacion: "2025-11-26T16:29:22.000000Z",
        },
        {
            id: 2,
            numero_documento: "602238139",
            estado: "aprobado",
            fecha_creacion: "2025-11-26T15:29:22.000000Z",
        },
    ],
    meta: {
        total: 50,
        current_page: 1,
        per_page: 10,
        last_page: 5,
        from: 1,
        to: 10,
    },
};

const post_solicitudes = {
    message: "Solicitud insertada correctamente",
    data: { id: 51 },
};

vi.mock("axios", () => {
    const mockFn = vi.fn();

    const mockGet = vi.fn((url?: string) => {
        if (typeof url === "string" && url.includes("/solicitudes")) {
            return Promise.resolve({ data: get_solicitudes });
        }
        return Promise.resolve({ data: {} });
    });

    const mockPost = vi.fn((url?: string) => {
        if (typeof url === "string" && url.includes("/solicitudes")) {
            return Promise.resolve({ data: post_solicitudes });
        }
        return Promise.resolve({ data: {} });
    });

    return {
        __esModule: true,
        default: {
            get: mockGet,
            post: mockPost,
            put: mockFn,
            delete: mockFn,
            isCancel: mockFn,
            create: () => ({
                get: mockFn,
                post: mockFn,
                put: mockFn,
                delete: mockFn,
            }),
        },
    };
});

try {
    const { createTestingPinia } = require("@pinia/testing");
    const testingPinia = createTestingPinia({ stubActions: true });
    config.global.plugins = config.global.plugins || [];
    config.global.plugins.push(testingPinia);
} catch (e) {
    console.log("Error: ", e);
}

class ResizeObserver {
    observe() {}
    unobserve() {}
    disconnect() {}
}

(globalThis as any).ResizeObserver = ResizeObserver;
