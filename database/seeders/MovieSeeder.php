<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvPath = base_path('csv/movie_list.csv');

        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setDelimiter(";");
        $csv->setHeaderOffset(0);

        foreach ($csv->getRecords() as $record) {
            DB::table('movies')->insert([
                'imdb_id' => $record["imdb_id"],
                'name' => $record["name"],
                'ticket_fee' => $record["ticket_fee"],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
