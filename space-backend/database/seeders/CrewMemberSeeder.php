<?php

namespace Database\Seeders;

use App\Models\CrewMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CrewMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data.json'));
        $data = json_decode($json);

        foreach ($data->crewData as $crewData) {
            CrewMember::create([
                'title' => $crewData->title,
                'subtitle' => $crewData->subtitle,
                'content' => $crewData->content,
                'srcm' => $crewData->srcm,
                'srct' => $crewData->srct,
                'srcd' => $crewData->srcd,
                'alt' => $crewData->alt,
            ]);
        }
    }
}
