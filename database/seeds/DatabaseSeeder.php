<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ReasonSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(TopicSeeder::class);
    }
}
