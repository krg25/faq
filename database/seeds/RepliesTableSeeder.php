<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::inRandomOrder();
        for ($i = 1; $i <= 6; $i++) {
            $users->each(function ($user) {
                $answer = App\Answer::inRandomOrder()->first();
                $reply = factory(\App\Reply::class)->make();
                $reply->user()->associate($user);
                $reply->answer()->associate($answer);
                $reply->save();
            });
        }
    }
}
