<?php

namespace Tests\Feature;

use App\Models\Solicitud;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SolicitudesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Getting solicitudes retrieves paginated results
     */
    public function test_index(): void
    {
        $items = Solicitud::factory(10)
            ->create();

        $response = $this->json('GET', '/api/solicitudes');

        $element = $items->random();

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    ['id', 'numero_documento', 'estado', 'fecha_creacion'],
                ],
                'meta' => [
                    'total',
                    'current_page',
                    'per_page',
                    'last_page',
                    'from',
                    'to',
                ],
            ])
            ->assertJsonFragment([
                'id' => $element->id,
                'numero_documento' => $element->document_no,
            ])
            ->assertJsonFragment([
                'total' => 10,
                'current_page' => 1,
                'per_page' => 15,
                'last_page' => 1,
                'from' => 1,
                'to' => 10,
            ]);
    }

    /**
     * Posting solicitudes without data retrieves validation errors
     */
    public function test_store_error(): void
    {
        $response = $this->json('POST', '/api/solicitudes');

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'numero_documento',
                ],
            ]);
    }

    /**
     * Posting solicitudes with data retrieves success
     */
    public function test_store_success(): void
    {
        $response = $this->json('POST', '/api/solicitudes', [
            'numero_documento' => '12345678',
            'estado' => 'pendiente',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                ],
            ])
            ->assertJsonFragment([
                'id' => 1,
            ]);
    }

    /**
     * Getting specific solicitud retrieves his data
     */
    public function test_show(): void
    {
        $solicitud = Solicitud::factory()
            ->create();

        $response = $this->json('GET', "/api/solicitudes/{$solicitud->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'numero_documento',
                    'estado',
                    'fecha_creacion',
                ],
            ])
            ->assertJsonFragment([
                'id' => $solicitud->id,
                'numero_documento' => $solicitud->document_no,
                'estado' => $solicitud->status,
            ]);
    }

    /**
     * Putting solicitud without data retrieves validation errors
     */
    public function test_update_error(): void
    {
        $solicitud = Solicitud::factory()
            ->create();

        $response = $this->json('PUT', "/api/solicitudes/{$solicitud->id}");

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'estado',
                ],
            ]);
    }

    /**
     * Putting solicitud with data retrieves success
     */
    public function test_update_success(): void
    {
        $solicitud = Solicitud::factory()
            ->create();

        $response = $this->json('PUT', "/api/solicitudes/{$solicitud->id}", [
            'estado' => 'aprobado',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);

        $response = $this->json('GET', "/api/solicitudes/{$solicitud->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'numero_documento',
                    'estado',
                    'fecha_creacion',
                ],
            ])
            ->assertJsonFragment([
                'id' => $solicitud->id,
                'estado' => 'aprobado',
            ]);
    }

    /**
     * Deleting solicitud retrieves success
     */
    public function test_delete(): void
    {
        $solicitud = Solicitud::factory()
            ->create();

        $response = $this->json('GET', "/api/solicitudes/{$solicitud->id}");

        $response->assertStatus(200);

        $response = $this->json('DELETE', "/api/solicitudes/{$solicitud->id}", [
            'numero_documento' => '12345679',
            'estado' => 'aprobado',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);

        $response = $this->json('GET', "/api/solicitudes/{$solicitud->id}");

        $response->assertStatus(404);
    }
}
