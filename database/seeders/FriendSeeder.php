<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        $friend = User::find(2);
        $friend2 = User::find(3);
        $friend3 = User::find(4);
        $friend4 = User::find(5);
        $friend5 = User::find(6);
        $friend6 = User::find(7);

        $user->friendsTo()->attach($friend);
        $user->friendsTo()->attach($friend2);
        $user->friendsTo()->attach($friend3, ['accepted' => true]);

        $user->friendsFrom()->attach($friend4);
        $user->friendsFrom()->attach($friend5);
        $user->friendsFrom()->attach($friend6, ['accepted' => true]);
    }
}
