<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => "KAFA",
            'phone_num' => "0123456789",
            'role' => "KAFAadmin",
            'email' => "kafa@test",
            'parent_id' => null,
            'password' => bcrypt("test"), // password
        ]);

        User::factory()->create([
            'name' => "MUIP",
            'phone_num' => "0123456789",
            'role' => "MUIPadmin",
            'email' => "muip@test",
            'parent_id' => null,
            'password' => bcrypt("test"), // password
        ]);

        User::factory()->create([
            'name' => "Teacher",
            'phone_num' => "0123456789",
            'role' => "teacher",
            'email' => "teacher@test",
            'parent_id' => null,
            'password' => bcrypt("test"), // password
        ]);

        User::factory()->create([
            'name' => "Parent",
            'phone_num' => "0123456789",
            'role' => "parent",
            'email' => "parent@test",
            'parent_id' => "PA123",
            'password' => bcrypt("test"), // password
        ]);

        User::factory()->create([
            'name' => "Wan",
            'phone_num' => "0123456789",
            'role' => "parent",
            'email' => "wan@test",
            'parent_id' => "PA124",
            'password' => bcrypt("test"), // password
        ]);

        User::factory()->create([
            'name' => "Dude",
            'phone_num' => "0123456789",
            'role' => "parent",
            'email' => "dude@test",
            'parent_id' => "PA125",
            'password' => bcrypt("test"), // password
        ]);

    }
}