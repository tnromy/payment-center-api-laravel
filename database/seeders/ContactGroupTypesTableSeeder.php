<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactGroupType;

class ContactGroupTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['name' => "Email"],
            ['name' => "Whatsapp"],
            ['name' => "Telegram"],
        ];

        foreach ($data as $d) {
            ContactGroupType::create($d);
        }
    }
}
