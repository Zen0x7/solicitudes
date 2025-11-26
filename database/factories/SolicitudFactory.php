<?php

namespace Database\Factories;

use App\Enums\EstadoSolicitud;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_no' => (string) fake()->randomNumber(9),
            'status' => fake()->randomElement(array_column(EstadoSolicitud::cases(), 'value')),
            'created_at' => now()->subHours(rand(1, 100)),
        ];
    }
}
