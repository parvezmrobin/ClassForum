<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [];

        foreach (['Admin', 'User'] as $role) {
            $r = new \App\Role();
            $r->role = $role;
            $r->save();
            $roles[] = $r;
        }

        foreach (\App\User::all() as $user) {
            $user->roles()->attach(array_random($roles)->id);
        }
    }
}
