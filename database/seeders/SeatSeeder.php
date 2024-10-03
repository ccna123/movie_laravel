<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvPath = base_path('csv/seat_list.csv');

        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setDelimiter(";");
        $csv->setHeaderOffset(0);

        foreach ($csv->getRecords() as $record) {

            DB::table('seats')->insert([
                'seat_code' => $record["seat_code"],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
