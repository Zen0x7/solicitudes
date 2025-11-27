export interface ISolicitud {
    id: string;
    numero_documento: string;
    estado: "pendiente" | "aprobado" | "rechazado";
    fecha_creacion: string;
}

export interface IPaginator {
    current_page: number;
    from: number;
    last_page: number;
    per_page: number;
    to: number;
    total: number;
}
