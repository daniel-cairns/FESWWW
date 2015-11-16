<?php

use Illuminate\Database\Seeder;
use App\Subbrand;

class SubbrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subbrands = [	'Weddings',
        				'Portraits',
        				'Seniors',
        				'Commercial',
        				'Models' 
    				];

        foreach ($subbrands as $subbrand) {
        	Subbrand::insert([
        		'name' 					=> $subbrand,
        		'description'			=> 'The '.$subbrand.' Description.',
        		'landing_description'	=> 'The '.$subbrand.' Landing Description.',
        		'caption'				=> 'The '.$subbrand.' Caption...',
        		'slug'					=> str_slug( $subbrand ),
        		'photo'					=> str_slug( $subbrand ).'-home.jpg',
        		'created_at'			=> "CURRENT_TIMESTAMP",
        		'updated_at'			=> "CURRENT_TIMESTAMP"

    		]);
        }
    }
}
