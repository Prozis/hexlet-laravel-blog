<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('articles')->insert([
           'name' => str_random(10),
           'body' => str_random(50),

       ]);
    }
}
