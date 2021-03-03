<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rols')->delete();

        \DB::table('rols')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name'=> 'admin'
                ),
        ));
        \DB::table('rols')->insert(array (
            1 =>
                array (
                    'id' => 2,
                    'name'=> 'moderator'
                ),
        ));

        \DB::table('rols')->insert(array (
            2 =>
                array (
                    'id' => 3,
                    'name'=> 'user'
                ),
        ));
    }
}
