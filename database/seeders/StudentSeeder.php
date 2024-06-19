<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Example data for students
         $students = [
            [
                'student_name' => 'Tan Jie Ying',
                'student_age' => 9,
                'student_gender' => 'Female',
                'student_birthRegNo' => 'AB1234',
                'student_ic' => '090101011234',
                'student_health' => 'healthy',
                'student_birthPlace' => 'Hospital Sultanah, Johor',
                'student_homeAddress' => 'No 19, Taman Tualang, Jalan Sungai Durian, 31800, Tanjung Tualang, Perak.',
                'student_regStatus' => 'Pending',
                'created_at' => '2023-06-06 06:06:06',
                'updated_at' => '2023-06-06 08:08:08',
            ],
            [
                'student_name' => 'Yan Hao Xiang',
                'student_age' => 10,
                'student_gender' => 'Male',
                'student_birthRegNo' => 'AB1235',
                'student_ic' => '090101011235',
                'student_health' => 'healthy',
                'student_birthPlace' => 'Hospital Amala, Perak',
                'student_homeAddress' => 'No 16, Taman Tualang, Jalan Sungai Durian, 31800, Tanjung Tualang, Perak.',
                'student_regStatus' => 'Pending',
                'created_at' => '2023-08-16 06:06:06',
                'updated_at' => '2023-08-16 08:08:08',
            ],
            [
                'student_name' => 'Nurul Siti Binti Abu',
                'student_age' => 8,
                'student_gender' => 'Female',
                'student_birthRegNo' => 'AB1236',
                'student_ic' => '090101011236',
                'student_health' => 'Has Asma',
                'student_birthPlace' => 'Hospital Melakaka, Pahang',
                'student_homeAddress' => 'No 88, Taman Harmoni, Jalan Manaka, Pekan, Pahang.',
                'student_regStatus' => 'Pending',
                'created_at' => '2024-01-16 06:06:06',
                'updated_at' => '2024-01-16 08:08:08',
            ],
            // Add more students as needed
            [
                'student_name' => 'Abu Bakar Bin Ali',
                'student_age' => 7,
                'student_gender' => 'Male',
                'student_birthRegNo' => 'AB1237',
                'student_ic' => '090101011237',
                'student_health' => 'Healthy',
                'student_birthPlace' => 'Hospital Manana, Pahang',
                'student_homeAddress' => 'No 99, Taman Wakaka, Jalan Manaka, Pekan, Pahang.',
                'student_regStatus' => 'Pending',
                'created_at' => '2024-04-16 06:06:06',
                'updated_at' => '2024-04-16 08:08:08',
            ],

            [
                'student_name' => 'Ashraf Ali Bin Abu Azim',
                'student_age' => 8,
                'student_gender' => 'Male',
                'student_birthRegNo' => 'AB1239',
                'student_ic' => '090101011239',
                'student_health' => 'Healthy',
                'student_birthPlace' => 'Hospital Lalala, Sabah',
                'student_homeAddress' => 'No 199, Taman Hulala, Jalan Kakaka, Sabah.',
                'student_regStatus' => 'Pending',
                'created_at' => '2024-06-01 06:06:06',
                'updated_at' => '2024-06-02 08:08:08',
            ],

            [
                'student_name' => 'Yogesh A/P Puvishnenes',
                'student_age' => 7,
                'student_gender' => 'Female',
                'student_birthRegNo' => 'AB1230',
                'student_ic' => '090101011230',
                'student_health' => 'Healthy',
                'student_birthPlace' => 'Hospital Kangan, Perlis',
                'student_homeAddress' => 'No  164, Jalan Kangan, Perlis.',
                'student_regStatus' => 'Pending',
                'created_at' => '2024-06-16 06:06:06',
                'updated_at' => '2024-06-16 08:08:08',
            ],
            [
                'student_name' => 'Yogesh A/P Puvishnenes',
                'student_age' => 11,
                'student_gender' => 'Female',
                'student_birthRegNo' => 'AB1230',
                'student_ic' => '090101011230',
                'student_health' => 'Healthy',
                'student_birthPlace' => 'Hospital Hage, Kelantan',
                'student_homeAddress' => 'No 192, Taman Abullah, Jalan Indah, Terengganu.',
                'student_regStatus' => 'Pending',
                'created_at' => '2024-06-18 06:06:06',
                'updated_at' => '2024-06-18 08:08:08',
            ],

        ];

        // Insert data into the students table
        foreach ($students as $student) {
            Student::create($student);
        }
    }
}

