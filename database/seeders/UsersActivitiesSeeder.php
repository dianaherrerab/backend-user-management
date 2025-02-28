<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersAndActivitiesSeeder extends Seeder
{
    public function run()
    {
        // Insertar usuarios
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'John Doe', 'email' => 'johndoe@example.com', 'phone' => '1234567890', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-28 18:54:19'), 'updated_at' => Carbon::parse('2025-02-28 18:54:19')],
            ['id' => 2, 'name' => 'Alice Smith', 'email' => 'alice.smith@example.com', 'phone' => '9876543210', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-28 20:12:09'), 'updated_at' => Carbon::parse('2025-02-28 20:12:09')],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob.johnson@example.com', 'phone' => '8765432109', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-17 20:12:23'), 'updated_at' => Carbon::parse('2025-02-28 20:12:23')],
            ['id' => 4, 'name' => 'Charlie Brown', 'email' => 'charlie.brown@example.com', 'phone' => '7654321098', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-07 20:12:35'), 'updated_at' => Carbon::parse('2025-02-28 20:12:35')],
            ['id' => 5, 'name' => 'David Wilson', 'email' => 'david.wilson@example.com', 'phone' => '6543210987', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-06 20:12:43'), 'updated_at' => Carbon::parse('2025-02-28 20:12:43')],
            ['id' => 6, 'name' => 'Emma Davis', 'email' => 'emma.davis@example.com', 'phone' => '5432109876', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-06 20:12:50'), 'updated_at' => Carbon::parse('2025-02-28 20:12:50')],
            ['id' => 7, 'name' => 'Frank Miller', 'email' => 'frank.miller@example.com', 'phone' => '4321098765', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-06 21:52:05'), 'updated_at' => Carbon::parse('2025-02-28 21:52:05')],
            ['id' => 8, 'name' => 'Grace Taylor', 'email' => 'grace.taylor@example.com', 'phone' => '3210987654', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-05 21:52:18'), 'updated_at' => Carbon::parse('2025-02-28 21:52:18')],
            ['id' => 9, 'name' => 'Henry White', 'email' => 'henry.white@example.com', 'phone' => '2109876543', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-03-04 21:52:27'), 'updated_at' => Carbon::parse('2025-02-28 21:52:27')],
            ['id' => 10, 'name' => 'Isabella Martinez', 'email' => 'isabella.martinez@example.com', 'phone' => '1098765432', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-24 21:52:37'), 'updated_at' => Carbon::parse('2025-02-28 21:52:37')],
            ['id' => 11, 'name' => 'Jack Anderson', 'email' => 'jack.anderson@example.com', 'phone' => '9087654321', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-23 21:52:51'), 'updated_at' => Carbon::parse('2025-02-28 21:52:51')],
            ['id' => 12, 'name' => 'Katie Thomas', 'email' => 'katie.thomas@example.com', 'phone' => '8076543210', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-02-22 21:53:00'), 'updated_at' => Carbon::parse('2025-02-28 21:53:00')],
            ['id' => 13, 'name' => 'Liam Hernandez', 'email' => 'liam.hernandez@example.com', 'phone' => '7065432109', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-01-21 21:53:34'), 'updated_at' => Carbon::parse('2025-02-28 21:53:34')],
            ['id' => 14, 'name' => 'Mia Scott', 'email' => 'mia.scott@example.com', 'phone' => '6054321098', 'password' => Hash::make('password123'), 'created_at' => Carbon::parse('2025-01-21 21:53:44'), 'updated_at' => Carbon::parse('2025-02-28 21:53:44')],
        ]);

        // Insertar actividades
        DB::table('activities')->insert([
            ['id' => 1, 'user_id' => 1, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 13:30:00'), 'updated_at' => Carbon::parse('2025-02-28 13:35:00')],
            ['id' => 2, 'user_id' => 1, 'action' => 'update_profile', 'created_at' => Carbon::parse('2025-02-28 13:40:00'), 'updated_at' => Carbon::parse('2025-02-28 13:45:00')],
            ['id' => 3, 'user_id' => 1, 'action' => 'logout', 'created_at' => Carbon::parse('2025-02-28 14:00:00'), 'updated_at' => Carbon::parse('2025-02-28 14:05:00')],

            ['id' => 4, 'user_id' => 2, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 14:15:30'), 'updated_at' => Carbon::parse('2025-02-28 14:20:30')],
            ['id' => 5, 'user_id' => 2, 'action' => 'password_change', 'created_at' => Carbon::parse('2025-02-28 14:30:00'), 'updated_at' => Carbon::parse('2025-02-28 14:35:00')],
            ['id' => 6, 'user_id' => 2, 'action' => 'update_profile', 'created_at' => Carbon::parse('2025-02-28 14:50:00'), 'updated_at' => Carbon::parse('2025-02-28 14:55:00')],
            ['id' => 7, 'user_id' => 2, 'action' => 'logout', 'created_at' => Carbon::parse('2025-02-28 15:10:00'), 'updated_at' => Carbon::parse('2025-02-28 15:15:00')],

            ['id' => 8, 'user_id' => 3, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 15:20:30'), 'updated_at' => Carbon::parse('2025-02-28 15:25:30')],
            ['id' => 9, 'user_id' => 3, 'action' => 'update_profile', 'created_at' => Carbon::parse('2025-02-28 15:35:00'), 'updated_at' => Carbon::parse('2025-02-28 15:40:00')],
            ['id' => 10, 'user_id' => 3, 'action' => 'password_change', 'created_at' => Carbon::parse('2025-02-28 15:50:10'), 'updated_at' => Carbon::parse('2025-02-28 15:55:10')],
            ['id' => 11, 'user_id' => 3, 'action' => 'logout', 'created_at' => Carbon::parse('2025-02-28 16:00:00'), 'updated_at' => Carbon::parse('2025-02-28 16:05:00')],

            ['id' => 12, 'user_id' => 4, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 16:10:00'), 'updated_at' => Carbon::parse('2025-02-28 16:15:00')],
            ['id' => 13, 'user_id' => 4, 'action' => 'password_change', 'created_at' => Carbon::parse('2025-02-28 16:25:30'), 'updated_at' => Carbon::parse('2025-02-28 16:30:30')],

            ['id' => 14, 'user_id' => 5, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 17:10:00'), 'updated_at' => Carbon::parse('2025-02-28 17:15:00')],

            ['id' => 15, 'user_id' => 6, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 18:00:00'), 'updated_at' => Carbon::parse('2025-02-28 18:05:00')],

            ['id' => 16, 'user_id' => 7, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 18:45:00'), 'updated_at' => Carbon::parse('2025-02-28 18:50:00')],

            ['id' => 17, 'user_id' => 8, 'action' => 'login', 'created_at' => Carbon::parse('2025-02-28 19:30:00'), 'updated_at' => Carbon::parse('2025-02-28 19:35:00')],
        ]);
    }
}
