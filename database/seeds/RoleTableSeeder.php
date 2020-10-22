<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //new roles
        $role_freelance = new \App\Role();
        $role_freelance->name = 'Freelance';
        $role_freelance->description = 'บทบาทฟรีแลนซ์';
        $role_freelance->save();

        $role_employer = new \App\Role();
        $role_employer->name = 'Employer';
        $role_employer->description = 'บทบาทผู้ว่าจ้าง';
        $role_employer->save();

    }
}
