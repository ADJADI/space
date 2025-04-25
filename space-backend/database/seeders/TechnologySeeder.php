<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data.json'));
        $data = json_decode($json);

        foreach ($data->technologyData as $technologyData) {
            Technology::create([
                'title' => $technologyData->title,
                'subtitle' => $technologyData->subtitle,
                'content' => $technologyData->content,
                'srcm' => $technologyData->srcm,
                'srct' => $technologyData->srct,
                'srcd' => $technologyData->srcd,
                'alt' => $technologyData->alt,
            ]);
        }
    }
}
