<?php

use Illuminate\Database\Seeder;

class MediaTypeRFSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mediaTypes = array('image', 'video');

        foreach($mediaTypes as $mediaType){
            DB::table('MEDIA_TYPE_RF')->insert([
                'me_t_type' => $mediaType
            ]);
        }
    }
}
