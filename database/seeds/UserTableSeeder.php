<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //new roles
        $role_freelance = Role::where('name', 'Freelance')->first();
        $role_employer = Role::where('name', 'Employer')->first();

        //new roles
        $freelance = new User();
        $freelance->first_name = 'Freelance';
        $freelance->last_name = 'test';
        $freelance->email = 'freelance@mail.com';
        $freelance->password = bcrypt('freelance');
        $freelance->save();
        $freelance->roles()->attach($role_freelance);

        $employer = new User();
        $employer->first_name = 'Employer';
        $employer->last_name = 'test';
        $employer->email = 'employer@mail.com';
        $employer->password = bcrypt('employer');
        $employer->save();
        $employer->roles()->attach($role_employer);



    }
}
