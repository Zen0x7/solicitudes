<?php

namespace Database\Seeders;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('migrate:refresh');

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Solicitud::factory(50)
            ->create();
    }
}
