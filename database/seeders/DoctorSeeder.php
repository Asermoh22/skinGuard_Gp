<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->truncate();
        $doctors = [
            [
                "name" => "Dr. Samar Hossam Omar",
                "price" => 450,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 1
            ],
            [
                "name" => "Dr. Mona Mostafa Korney",
                "price" => 500,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 2
            ],
            [
                "name" => "Dr. Shimaa Mahmoud",
                "price" => 400,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 3
            ],
            [
                "name" => "Dr. Nayera Moftah",
                "price" => 500,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 4
            ],
            [
                "name" => "Dr. Ahmed Samir",
                "price" => 500,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 2
            ],
            [
                "name" => "Dr. Marwa Elshahed",
                "price" => 450,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 5
            ],
            [
                "name" => "Dr. Amany Anwar",
                "price" => 400,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 6
            ],
            [
                "name" => "Dr. Rania Shawky",
                "price" => 450,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 7
            ],
            [
                "name" => "Dr. Omar Abdelaziz",
                "price" => 550,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 8
            ],
            [
                "name" => "Dr. Hesham Lotfy",
                "price" => 600,
                "specialization" => "Adult Dermatology, Cosmetic Dermatology and Laser and Pediatric Dermatology",
                "city_id" => 9
            ],
            ['name' => 'Dr. Ahmed Youssef', 'price' => 300, 'specialization' => 'Cardiology', 'city_id' => 1],
            ['name' => 'Dr. Mona Ibrahim', 'price' => 250, 'specialization' => 'Dermatology', 'city_id' => 2],
            ['name' => 'Dr. Omar Salah', 'price' => 200, 'specialization' => 'Pediatrics', 'city_id' => 3],
            ['name' => 'Dr. Yasmine Adel', 'price' => 350, 'specialization' => 'Neurology', 'city_id' => 4],
            ['name' => 'Dr. Hossam Tarek', 'price' => 400, 'specialization' => 'Orthopedics', 'city_id' => 5],
            ['name' => 'Dr. Sara Hassan', 'price' => 270, 'specialization' => 'Ophthalmology', 'city_id' => 6],
            ['name' => 'Dr. Mohamed Fathy', 'price' => 320, 'specialization' => 'ENT', 'city_id' => 7],
            ['name' => 'Dr. Lamia Khaled', 'price' => 290, 'specialization' => 'Gynecology', 'city_id' => 8],
            ['name' => 'Dr. Amr Nabil', 'price' => 310, 'specialization' => 'Urology', 'city_id' => 9],
            ['name' => 'Dr. Nada Sameh', 'price' => 260, 'specialization' => 'Psychiatry', 'city_id' => 10],
            ['name' => 'Dr. Karim Salah', 'price' => 280, 'specialization' => 'Cardiology', 'city_id' => 11],
    ['name' => 'Dr. Rania Mohamed', 'price' => 240, 'specialization' => 'Dermatology', 'city_id' => 12],
    ['name' => 'Dr. Tarek Hany', 'price' => 220, 'specialization' => 'Pediatrics', 'city_id' => 13],
    ['name' => 'Dr. Dalia Hassan', 'price' => 370, 'specialization' => 'Neurology', 'city_id' => 14],
    ['name' => 'Dr. Ahmed Fadel', 'price' => 420, 'specialization' => 'Orthopedics', 'city_id' => 15],
    ['name' => 'Dr. Noha Samir', 'price' => 260, 'specialization' => 'Ophthalmology', 'city_id' => 16],
    ['name' => 'Dr. Ayman Adel', 'price' => 330, 'specialization' => 'ENT', 'city_id' => 17],
    ['name' => 'Dr. Yara Khaled', 'price' => 300, 'specialization' => 'Gynecology', 'city_id' => 18],
    ['name' => 'Dr. Omar Nabil', 'price' => 310, 'specialization' => 'Urology', 'city_id' => 19],
    ['name' => 'Dr. Samar Mahmoud', 'price' => 255, 'specialization' => 'Psychiatry', 'city_id' => 20],
    ['name' => 'Dr. Hassan Mostafa', 'price' => 280, 'specialization' => 'Cardiology', 'city_id' => 21],
    ['name' => 'Dr. Lina Youssef', 'price' => 230, 'specialization' => 'Dermatology', 'city_id' => 22],
    ['name' => 'Dr. Wael Tamer', 'price' => 210, 'specialization' => 'Pediatrics', 'city_id' => 23],
    ['name' => 'Dr. Salma ElSayed', 'price' => 360, 'specialization' => 'Neurology', 'city_id' => 24],
    ['name' => 'Dr. Hany Gaber', 'price' => 390, 'specialization' => 'Orthopedics', 'city_id' => 25],
    ['name' => 'Dr. Marwa Ahmed', 'price' => 275, 'specialization' => 'Ophthalmology', 'city_id' => 26],
    ['name' => 'Dr. Khaled Fathy', 'price' => 340, 'specialization' => 'ENT', 'city_id' => 27],
    ['name' => 'Dr. Nermin Tarek', 'price' => 295, 'specialization' => 'Gynecology', 'city_id' => 28],
    ['name' => 'Dr. Sherif Nabil', 'price' => 320, 'specialization' => 'Urology', 'city_id' => 29],
    ['name' => 'Dr. Rasha Saeed', 'price' => 250, 'specialization' => 'Psychiatry', 'city_id' => 30],
    ['name' => 'Dr. Amira Gamal', 'price' => 265, 'specialization' => 'Cardiology', 'city_id' => 31],
    ['name' => 'Dr. Mohsen Kamel', 'price' => 245, 'specialization' => 'Dermatology', 'city_id' => 32],
    ['name' => 'Dr. Walaa Magdy', 'price' => 215, 'specialization' => 'Pediatrics', 'city_id' => 33],
    ['name' => 'Dr. Youssef Adel', 'price' => 380, 'specialization' => 'Neurology', 'city_id' => 34],
    ['name' => 'Dr. Haidy Mahmoud', 'price' => 410, 'specialization' => 'Orthopedics', 'city_id' => 35],
    ['name' => 'Dr. Ahmed Sobhy', 'price' => 280, 'specialization' => 'Ophthalmology', 'city_id' => 36],
    ['name' => 'Dr. Farah Saad', 'price' => 335, 'specialization' => 'ENT', 'city_id' => 37],
    ['name' => 'Dr. Ayman Khalil', 'price' => 310, 'specialization' => 'Gynecology', 'city_id' => 38],
    ['name' => 'Dr. Huda Abdel Rahman', 'price' => 300, 'specialization' => 'Urology', 'city_id' => 39],
    ['name' => 'Dr. Malak Samy', 'price' => 255, 'specialization' => 'Psychiatry', 'city_id' => 40],
    ['name' => 'Dr. Tarek Mahmoud', 'price' => 290, 'specialization' => 'Cardiology', 'city_id' => 41],
    ['name' => 'Dr. Heba Nasser', 'price' => 240, 'specialization' => 'Dermatology', 'city_id' => 42],
    ['name' => 'Dr. Kareem Yassin', 'price' => 220, 'specialization' => 'Pediatrics', 'city_id' => 43],
    ['name' => 'Dr. Dina Salah', 'price' => 370, 'specialization' => 'Neurology', 'city_id' => 44],
    ['name' => 'Dr. Mohamed Fathy', 'price' => 420, 'specialization' => 'Orthopedics', 'city_id' => 45],
    ['name' => 'Dr. Yasmeen Samir', 'price' => 285, 'specialization' => 'Ophthalmology', 'city_id' => 46],
    ['name' => 'Dr. Hatem Elsayed', 'price' => 345, 'specialization' => 'ENT', 'city_id' => 47],
    ['name' => 'Dr. Nourhan Khaled', 'price' => 315, 'specialization' => 'Gynecology', 'city_id' => 48],
    ['name' => 'Dr. Yasser Ali', 'price' => 325, 'specialization' => 'Urology', 'city_id' => 49],
    ['name' => 'Dr. Sara Adel', 'price' => 260, 'specialization' => 'Psychiatry', 'city_id' => 50],
    ['name' => 'Dr. Omar Hisham', 'price' => 275, 'specialization' => 'Cardiology', 'city_id' => 51],
    ['name' => 'Dr. Reem Mostafa', 'price' => 255, 'specialization' => 'Dermatology', 'city_id' => 52],
    ['name' => 'Dr. Hassan Abdelrahman', 'price' => 225, 'specialization' => 'Pediatrics', 'city_id' => 53],
    ['name' => 'Dr. Layla Nabil', 'price' => 390, 'specialization' => 'Neurology', 'city_id' => 54],
    ['name' => 'Dr. Mahmoud Gawad', 'price' => 430, 'specialization' => 'Orthopedics', 'city_id' => 55],
    ['name' => 'Dr. Hagar Said', 'price' => 290, 'specialization' => 'Ophthalmology', 'city_id' => 56],
    ['name' => 'Dr. Ahmed Gamal', 'price' => 350, 'specialization' => 'ENT', 'city_id' => 57],
    ['name' => 'Dr. Samar Mostafa', 'price' => 320, 'specialization' => 'Gynecology', 'city_id' => 58],
    ['name' => 'Dr. Rami Wael', 'price' => 310, 'specialization' => 'Urology', 'city_id' => 59],
    ['name' => 'Dr. Basma Hassan', 'price' => 265, 'specialization' => 'Psychiatry', 'city_id' => 60],
    ['name' => 'Dr. Khaled Samir', 'price' => 280, 'specialization' => 'Cardiology', 'city_id' => 61],
    ['name' => 'Dr. Manal Ahmed', 'price' => 230, 'specialization' => 'Dermatology', 'city_id' => 62],
    ['name' => 'Dr. Nabil Hassan', 'price' => 210, 'specialization' => 'Pediatrics', 'city_id' => 63],
    ['name' => 'Dr. Hadeer Tarek', 'price' => 360, 'specialization' => 'Neurology', 'city_id' => 64],
    ['name' => 'Dr. Wael Saad', 'price' => 410, 'specialization' => 'Orthopedics', 'city_id' => 65],
    ['name' => 'Dr. Dalia Farid', 'price' => 275, 'specialization' => 'Ophthalmology', 'city_id' => 66],
    ['name' => 'Dr. Mohamed Reda', 'price' => 330, 'specialization' => 'ENT', 'city_id' => 67],
    ['name' => 'Dr. Sara Hisham', 'price' => 305, 'specialization' => 'Gynecology', 'city_id' => 68],
    ['name' => 'Dr. Osama Nasser', 'price' => 315, 'specialization' => 'Urology', 'city_id' => 69],
    ['name' => 'Dr. Lamis Khaled', 'price' => 255, 'specialization' => 'Psychiatry', 'city_id' => 70],
    ['name' => 'Dr. Ahmed Elsayed', 'price' => 295, 'specialization' => 'Cardiology', 'city_id' => 71],
    ['name' => 'Dr. Nourhan Hamed', 'price' => 235, 'specialization' => 'Dermatology', 'city_id' => 72],
    ['name' => 'Dr. Rami Tarek', 'price' => 220, 'specialization' => 'Pediatrics', 'city_id' => 73],
    ['name' => 'Dr. Fatma Khalil', 'price' => 375, 'specialization' => 'Neurology', 'city_id' => 74],
    ['name' => 'Dr. Ibrahim Mostafa', 'price' => 425, 'specialization' => 'Orthopedics', 'city_id' => 75],
    ['name' => 'Dr. Salma Yasser', 'price' => 280, 'specialization' => 'Ophthalmology', 'city_id' => 76],
    ['name' => 'Dr. Mahmoud Elhady', 'price' => 340, 'specialization' => 'ENT', 'city_id' => 77],
    ['name' => 'Dr. Amina Ahmed', 'price' => 310, 'specialization' => 'Gynecology', 'city_id' => 78],
    ['name' => 'Dr. Ehab Sameh', 'price' => 320, 'specialization' => 'Urology', 'city_id' => 79],
    ['name' => 'Dr. Basant Tamer', 'price' => 265, 'specialization' => 'Psychiatry', 'city_id' => 80],
        ['name' => 'Dr. Hassan Mahmoud', 'price' => 310, 'specialization' => 'Cardiology', 'city_id' => 1],
    ['name' => 'Dr. Youssef Gamal', 'price' => 290, 'specialization' => 'Cardiology', 'city_id' => 1],
    ['name' => 'Dr. Farid Tamer', 'price' => 305, 'specialization' => 'Cardiology', 'city_id' => 1],

    // City 2 - Dermatology
    ['name' => 'Dr. Salma Ehab', 'price' => 240, 'specialization' => 'Dermatology', 'city_id' => 2],
    ['name' => 'Dr. Nour Ayman', 'price' => 260, 'specialization' => 'Dermatology', 'city_id' => 2],
    ['name' => 'Dr. Rania Essam', 'price' => 255, 'specialization' => 'Dermatology', 'city_id' => 2],
    ['name' => 'Dr. Basma Khaled', 'price' => 265, 'specialization' => 'Dermatology', 'city_id' => 2],
    ['name' => 'Dr. Hatem Sami', 'price' => 250, 'specialization' => 'Dermatology', 'city_id' => 2],

    // City 3 - Pediatrics
    ['name' => 'Dr. Hany Adel', 'price' => 220, 'specialization' => 'Pediatrics', 'city_id' => 3],
    ['name' => 'Dr. Dina Hossam', 'price' => 230, 'specialization' => 'Pediatrics', 'city_id' => 3],
    ['name' => 'Dr. Mostafa Kamel', 'price' => 210, 'specialization' => 'Pediatrics', 'city_id' => 3],

    // City 4 - Neurology
    ['name' => 'Dr. Ibrahim Khalil', 'price' => 370, 'specialization' => 'Neurology', 'city_id' => 4],
    ['name' => 'Dr. Sherif Hady', 'price' => 360, 'specialization' => 'Neurology', 'city_id' => 4],
    ['name' => 'Dr. Nada Ihab', 'price' => 380, 'specialization' => 'Neurology', 'city_id' => 4],

    // City 5 - Orthopedics
    ['name' => 'Dr. Sami Tarek', 'price' => 430, 'specialization' => 'Orthopedics', 'city_id' => 5],
    ['name' => 'Dr. Adel Mostafa', 'price' => 420, 'specialization' => 'Orthopedics', 'city_id' => 5],
    ['name' => 'Dr. Laila Kamal', 'price' => 435, 'specialization' => 'Orthopedics', 'city_id' => 5],

    // City 6 - Ophthalmology
    ['name' => 'Dr. Karim Wael', 'price' => 290, 'specialization' => 'Ophthalmology', 'city_id' => 6],
    ['name' => 'Dr. Hala Amr', 'price' => 280, 'specialization' => 'Ophthalmology', 'city_id' => 6],
    ['name' => 'Dr. Hossam Yasser', 'price' => 295, 'specialization' => 'Ophthalmology', 'city_id' => 6],

    // City 7 - ENT
    ['name' => 'Dr. Hisham Saeed', 'price' => 330, 'specialization' => 'ENT', 'city_id' => 7],
    ['name' => 'Dr. Yasmeen Fathy', 'price' => 335, 'specialization' => 'ENT', 'city_id' => 7],
    ['name' => 'Dr. Nader Reda', 'price' => 345, 'specialization' => 'ENT', 'city_id' => 7],

    // City 8 - Gynecology
    ['name' => 'Dr. Amira Essam', 'price' => 315, 'specialization' => 'Gynecology', 'city_id' => 8],
    ['name' => 'Dr. Nourhan Galal', 'price' => 320, 'specialization' => 'Gynecology', 'city_id' => 8],
    ['name' => 'Dr. Marwan Tarek', 'price' => 325, 'specialization' => 'Gynecology', 'city_id' => 8],

    // City 9 - Urology
    ['name' => 'Dr. Osama Mahmoud', 'price' => 325, 'specialization' => 'Urology', 'city_id' => 9],
    ['name' => 'Dr. Dina Yasser', 'price' => 315, 'specialization' => 'Urology', 'city_id' => 9],
    ['name' => 'Dr. Ahmed Hady', 'price' => 330, 'specialization' => 'Urology', 'city_id' => 9],

    // City 10 - Psychiatry
    ['name' => 'Dr. Laila Khaled', 'price' => 275, 'specialization' => 'Psychiatry', 'city_id' => 10],
    ['name' => 'Dr. Tarek Salah', 'price' => 280, 'specialization' => 'Psychiatry', 'city_id' => 10],
    ['name' => 'Dr. Mohamed Nabil', 'price' => 290, 'specialization' => 'Psychiatry', 'city_id' => 10]
    
    
        
        ];
        

        DB::table('doctors')->insert($doctors);
        

    }
}

