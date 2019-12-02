<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
    	'company_id'=>factory(Company::class),
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'email'=>$faker->email,
        'phone'=>$faker->phoneNumber,
    ];
});
