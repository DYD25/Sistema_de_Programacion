<?php

namespace Database\Seeders;

use App\Models\Iglesia;
use Illuminate\Database\Seeder;


class IglesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Iglesia::factory(5)->create();
    }
}
