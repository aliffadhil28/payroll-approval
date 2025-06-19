<?php

namespace Database\Seeders;

use App\Models\Payroll;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $userData = [
            [
                'name' => 'Manager 1',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'basic_salary' => 30000000.00,
                'payment_date' => '11'
            ],
            [
                'name' => 'Finance 1',
                'email' => 'finance@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'finance',
                'basic_salary' => 20000000.00,
                'payment_date' => '12'
            ],
            [
                'name' => 'User 1',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'basic_salary' => 13000000.00,
                'payment_date' => '13'
            ],
            [
                'name' => 'Director 1',
                'email' => 'director@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'director',
                'basic_salary' => 4000000.00,
                'payment_date' => '14'
            ]
        ];

        foreach($userData as $item){
            $user = User::create([
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => $item['password'],
                'role' => $item['role']
            ]);

            Payroll::create([
                'user_id' => $user->id,
                'basic_Salary' => $item['basic_salary'],
                'payment_date' => $item['payment_date']
            ]);
        }
    }
}
