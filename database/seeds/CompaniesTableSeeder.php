<?php

use App\Company;
use App\Employee;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 5)->create()->each(function ($company) {
        $company->employees()->saveMany(factory(App\Employee::class, 20)->make());
        });
    }
}
