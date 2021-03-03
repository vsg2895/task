<?php

use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('reasons')->delete();

        \DB::table('reasons')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name'=> 'Reason1'
                ),
        ));
        \DB::table('reasons')->insert(array (
            1 =>
                array (
                    'id' => 2,
                    'name'=> 'Reason2'
                ),
        ));

        \DB::table('reasons')->insert(array (
            2 =>
                array (
                    'id' => 3,
                    'name'=> 'Reason3'
                ),
        ));
    }
}
