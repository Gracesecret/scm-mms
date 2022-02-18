<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 20; $i++){

            DB::table('suplier')->insert([
                'nama_agen' => $faker->name,
                'nama_cv' => $faker->company,
                'alamat' => $faker->address,
                'telp' => $faker->phoneNumber,
                'telp_agen' => $faker->phoneNumber,
                'e-mail' => $faker->email,
            ]);
        }


        //
    }
}
