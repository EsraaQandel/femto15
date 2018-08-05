<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	$user = new User();
        $user->name = 'Admin';
        $user->email = 'esraamedhatesamir@gmail.com';
        $user->password = bcrypt('admin');
        $user->user_type = 'admin';
        $user->company_id = 1;
        $user->phone = "01124208383";
        $user->remember_token = 'horbusloqp';
        $user->status = 1;
        $user->save();
        factory(App\User::class, 25)->create();
    }
}
