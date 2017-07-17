<?php

use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Male', 'Female', 'Other'] as $sex) {
            DB::table('sexes')->insert([
                'sex' => $sex,
            ]);
        }
    }
}
