<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	$company = new Company();
    	$company->name = 'system';
    	$company->tel = '01124580225';
    	$company->address = 'online system';
    	$company->email = 'online system';
    	$company->save();
        factory(App\Company::class, 5)->create();
    }
}
