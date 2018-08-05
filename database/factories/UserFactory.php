<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(App\Company::class, function (Faker $faker) {

    return [
        
        'name' => $faker->company,
        'tel' => $faker->tollFreePhoneNumber,
        'address' => $faker->streetAddress,
        'email' => $faker->email,
        'domain' => $faker->domainName,
     ];
});

$factory->define(App\User::class, function (Faker $faker) {

    return [
        
        'name' => $faker->name,
        'phone' => $faker->tollFreePhoneNumber,
        'password' => bcrypt('secret') ,
        'company_id' => $faker->numberBetween($min = 2, $max = 5),
        'email' => $faker->email,
        'status' => 1,
        'remember_token' => str_random(10),
     ];
});