<?php

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('topics')->delete();

        \DB::table('topics')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name'=> 'Topic1'
                ),
        ));
        \DB::table('topics')->insert(array (
            1 =>
                array (
                    'id' => 2,
                    'name'=> 'Topic2'
                ),
        ));

        \DB::table('topics')->insert(array (
            2 =>
                array (
                    'id' => 3,
                    'name'=> 'Topic3'
                ),
        ));
    }
}
