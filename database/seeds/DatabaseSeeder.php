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
        $this->call(DividesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(TechnologiesTableSeeder::class); 
        $this->call(WorksTableSeeder::class);    
        $this->call(ContactsTableSeeder::class);
    }
}
