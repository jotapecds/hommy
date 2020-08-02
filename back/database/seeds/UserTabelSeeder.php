<?php

use Illuminate\Database\Seeder;

class UserTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory (App\User::class,20)->create()->each(function ($user) {
        $republic = factory(App\Republic::class)->make();
        $user->republic()->save($republic);
        $republic->userFavoritas()->attach($user);
    });
    }
}
