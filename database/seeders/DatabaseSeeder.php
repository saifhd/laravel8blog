<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user=new User();
        $user->name="Saiful Islam";
        $user->email="Saifhd85@gmail.com";
        $user->password=Hash::make("saif1234");
        $user->save();


        \App\Models\Post::factory(30)->create([
            'user_id'=>$user->id
        ]);
    }
}
