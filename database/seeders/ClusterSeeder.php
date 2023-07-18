<?php

namespace Database\Seeders;

use App\Models\Cluster;
use Illuminate\Database\Seeder;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cluster::create([
            [
                'title' => 'Sedang'
            ],
            [
                "title" => "Tinggi"
            ],
            [
                "title" => "Rendah"
            ]
        ]);
    }
}
