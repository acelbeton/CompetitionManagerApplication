<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phoneNumber = '+36' . str_shuffle('301234567');

        DB::table('users')->insert([
           'name' => 'Str::random(10)',
           'email' => Str::random(10).'@example.com',
            'password' => Hash::make('password'),
            'phone' => $phoneNumber,
            'address' => 'Baratsag utca 9'
        ]);
    }

    //            $table->string('email')->unique();
    //            $table->string('name');
    //            $table->string('password');
    //            $table->string('phone');
    //            $table->string('address');
}
