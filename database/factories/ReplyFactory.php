<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        //
        'body' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),

    ];
});
