<?php

use Illuminate\Database\Seeder;

class DividesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Divide::class, 5)->create();
    }
}
