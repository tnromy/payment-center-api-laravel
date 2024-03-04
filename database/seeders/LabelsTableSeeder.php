<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Label;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
                        [
                'email_id' => 1,
                'name' => 'inbox',
            ],

            [
                'email_id' => 1,
                'name' => 'sent',
            ],

            [
                'email_id' => 1,
                'name' => 'draf',
            ],

            [
                'email_id' => 1,
                'name' => 'spam',
            ],

            [
                'email_id' => 1,
                'name' => 'stared',
            ],

                        [
                'email_id' => 1,
                'name' => 'support@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'designer@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'edu@tnromy.com',
            ],
            [
                'email_id' => 1,
                'name' => 'finance@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'marketplace@tnromy.com',
            ],
            [
                'email_id' => 1,
                'name' => 'media@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'office@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'server@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'services@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'sso@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'support@rtoc.id',
            ],
            [
                'email_id' => 1,
                'name' => 'tasya@cybercenter.co.id',
            ],
            [
                'email_id' => 1,
                'name' => 'tnromy@cybercenter.co.id',
            ],
        ];

        foreach ($data as $d) {
            label::create($d);
        }
    }
}
