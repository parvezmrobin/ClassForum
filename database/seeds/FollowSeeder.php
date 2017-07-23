<?php

use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = \App\Thread::all();
        $channels = \App\Channel::all();
        $users = \App\User::all();

        foreach ($users as $user) {
            foreach ($threads->random(3) as $thread) {
                $thread->followedBy()->attach($user->id);
                $thread->favoriteBy()->attach($user->id);
            }

            foreach ($channels->random(3) as $channel) {
                $channel->followedBy()->attach($user->id);
            }

            foreach ($users->random(3) as $user2) {
                $user2->followedBy()->attach($user->id);
            }
        }
    }
}
