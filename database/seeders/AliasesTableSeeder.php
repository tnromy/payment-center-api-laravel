<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alias;

class AliasesTableSeeder extends Seeder
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
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'support@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'designer@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'edu@tnromy.com',
                'from_name' => 'Romi Fadli'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'finance@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'marketplace@tnromy.com',
                'from_name' => 'Romi Fadli'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'media@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'office@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'server@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'services@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'sso@cybercenter.co.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'support@rtoc.id',
                'from_name' => 'PT. Indonesia Cyber Center'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'tasya@cybercenter.co.id',
                'from_name' => 'Tasya | Cyber Center PT'
            ],

            [
                'email_id' => 1,
                'user_id' => 'ef646ac3-a91d-4a28-8355-be0733e28103',
                'from_addr' => 'tnromy@cybercenter.co.id',
                'from_name' => 'Romi | Cyber Center PT'
            ],
        ];

        foreach($data as $d) {
            alias::create($d);
        }
    }
}
