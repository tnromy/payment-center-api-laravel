<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailConfig;

class EmailConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [

                'mailer' => "smtp",
            'host' => "smtp.gmail.com",
            'port' => 587,
            'username' => "inside@tnromy.com",
            'password' => "yjny kioc ivgi qrfv",
            'enc' => "tls",
    
            ],

             [

                'mailer' => "smtp",
            'host' => "smtp.gmail.com",
            'port' => 587,
            'username' => "indonesiacybercenter@gmail.com",
            'password' => "mavj tmmn gwlt slem",
            'enc' => "tls",
    
            ],
        ];

        foreach($data as $d) {
            EmailConfig::create($d);
        }
    }
}
