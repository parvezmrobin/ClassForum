<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SexSeeder::class);
        $this->call(ChannelSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ThreadSeeder::class);
        $this->call(EditHistorySeeder::class);
        $this->call(AnswerSeeder::class);
        $this->call(ReplySeeder::class);
        $this->call(FollowSeeder::class);
    }
}
