<?php

namespace Database\Seeders;

use App\Models\Rombel;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kelas = Rombel::get();
        foreach ($kelas as $row) {
            for ($i = 1; $i <= 30; $i++) {
                $student = Student::insert([
                    'name' => $faker->name(),
                    'nisn' => $row->id . '' . $faker->randomNumber(5, true) . '' . rand(2, 50),
                    'address' => $faker->address(),
                    'gender' => $faker->randomKey(['Pria' => '1', 'Wanita' => '2']),
                    'created_by' => 1,
                    'rombel_id' => $row->id,
                ]);
            }
        }
    }
}
