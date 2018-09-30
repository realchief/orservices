<?php

use Illuminate\Database\Seeder;

class SettingGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('settings')->delete();
         DB::table('settings')->insert([
			    [		'id' 			=> '1',
                        'airtable_name'         => 'DOROT Resource Guide (ORAT1.1)',
			    		'base_name' 		=> 'appPeL7kL29MLnxOk',
			    		'api_key' 		=> 'keyYZBR92wBEpciZf',
                        'link'         => 'https://airtable.com/universe/expTMdQFD5r9G6V9Y/open-referral-human-services-template',
                        'note'         => '',			    		
			    ]

			]); 
    }
}