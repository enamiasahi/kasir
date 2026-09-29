<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akun = [
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'administrator'
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@example.com',
                'password' => bcrypt('password'),
                'role' => 'kasir'
            ],
            [
                'name' => 'Waiter',
                'email' => 'waiter@example.com',
                'password' => bcrypt('password'),
                'role' => 'waiter'
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@example.com',
                'password' => bcrypt('password'),
                'role' => 'owner'
            ]
        ];

        foreach ($akun as $data) {
            User::create($data);
        }

    }
}
