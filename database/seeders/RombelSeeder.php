<?php

namespace Database\Seeders;

use App\Models\level;
use App\Models\rombel;
use Illuminate\Database\Seeder;

class RombelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level =  level::get();
        foreach ($level as $row) {
            $rombel = rombel::create([
                'name' => 'A',
                'level_id' => $row->id
            ]);
            $rombel = rombel::create([
                'name' => 'B',
                'level_id' => $row->id
            ]);
            $rombel = rombel::create([
                'name' => 'C',
                'level_id' => $row->id
            ]);
            $rombel = rombel::create([
                'name' => 'D',
                'level_id' => $row->id
            ]);
        }
    }
}
