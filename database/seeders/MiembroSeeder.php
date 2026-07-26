<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Miembro;

class MiembroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Miembro::factory(50)->create();
    }
}
