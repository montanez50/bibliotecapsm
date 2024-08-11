<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Editorial;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Editorial::create(['nombre' => 'Mc Graw Hill']);
        Editorial::create(['nombre' => 'Editorial Ariel']);
        Editorial::create(['nombre' => 'Ediciones Paidós']);
        Editorial::create(['nombre' => 'Editorial EUDEBA']);
    }
}
