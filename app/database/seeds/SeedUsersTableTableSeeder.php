<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class SeedUsersTableTableSeeder extends Seeder
{

    public function run()
    {


        DB::table('users')->truncate();

        $users = [
            [
                'first_name' => 'Yash',
                'last_name' => 'Gaikawad',
                'email' => 'yashwant.gaikawad@gmail.com',
                'is_admin' => true,
                'password' => Hash::make('yash')
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'test.user@gmail.com',
                'is_admin' => false,
                'password' => Hash::make('test')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }

}
