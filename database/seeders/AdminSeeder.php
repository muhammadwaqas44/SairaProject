<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'id' => 1,
                "name" => "Super Admin",
                "email" => "admin@admin.com",
                "password" => bcrypt("12345678"),
            ],
        ];
        foreach ($admins as $admin) {
            \App\Models\User::create([
                'id' => $admin['id'],
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => $admin['password'],
            ]);
        }

    }
}
