<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data.json'));
        $data = json_decode($json);

        foreach ($data->destinationData as $destinationData) {
            Destination::create([
                'title' => $destinationData->title,
                'content' => $destinationData->content,
                'km' => $destinationData->km,
                'days' => $destinationData->days,
                'srcm' => $destinationData->srcm,
                'srct' => $destinationData->srct,
                'srcd' => $destinationData->srcd,
                'alt' => $destinationData->alt,
            ]);
        }
    }
}
