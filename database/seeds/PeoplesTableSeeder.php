<?php

use Illuminate\Database\Seeder;

class PeoplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\People::class, 10)->create()->each(function ($people) {
            $people->MedicalRecords()->save(factory(App\MedicalRecords::class)->make());
        });
    }
}
