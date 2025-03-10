<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class governorateseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cities = [
            ["name" => "Cairo"],
            ["name" => "Giza"],
            ["name" => "Alexandria"],
            ["name" => "Dakahlia"],
            ["name" => "Red Sea"],
            ["name" => "Beheira"],
            ["name" => "Fayoum"],
            ["name" => "Gharbiya"],
            ["name" => "Ismailia"],
            ["name" => "Menofia"],
            ["name" => "Minya"],
            ["name" => "Qaliubiya"],
            ["name" => "New Valley"],
            ["name" => "Suez"],
            ["name" => "Aswan"],
            ["name" => "Assiut"],
            ["name" => "Beni Suef"],
            ["name" => "Port Said"],
            ["name" => "Damietta"],
            ["name" => "Sharkia"],
            ["name" => "South Sinai"],
            ["name" => "Kafr Al sheikh"],
            ["name" => "Matrouh"],
            ["name" => "Luxor"],
            ["name" => "Qena"],
            ["name" => "North Sinai"],
            ["name" => "Sohag"]
        ];
        DB::table('governorates')->insert($cities);
    }
}
