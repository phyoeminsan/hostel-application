<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\academic_year;
use App\Models\year;
use App\Models\student;
use App\Models\student_record;
use App\Models\hostel;
use App\Models\hostel_allocation;
use App\Models\room;
use App\Models\hostel_application;
use App\Models\Payment;
use App\Models\major;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Academic_year::factory(10)->create();
        Year::factory(5)->create();
        Major::factory(3)->create();
        Student::factory(10)->create();
        Hostel::factory(3)->create();
        Room::factory(20)->create();
        Student_record::factory(10)->create();
        Hostel_application::factory(10)->create();
        Payment::factory(10)->create();
        Hostel_allocation::factory(10)->create();

        Admin::create([
            'email' => 'admin@gamil.com',
            'password' => Hash::make('12345678'), 
        ]);
    }
}
