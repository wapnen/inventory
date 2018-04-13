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
        // $this->call(UsersTableSeeder::class);
         $this->call(StatesTableSeeder::class);
		  $this->call(Lgas_1_TableSeeder::class);
		  $this->call(Lgas_2_TableSeeder::class);
		  $this->call(Lgas_3_TableSeeder::class);
		  $this->call(Lgas_4_TableSeeder::class);
    }
}
