<?php

use Illuminate\Database\Seeder;

class EditHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\EditHistory::class, 30)->create();
    }
}
