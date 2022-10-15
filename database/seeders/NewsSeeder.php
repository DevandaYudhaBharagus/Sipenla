<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i <= 9; $i++) {
            $news = News::create([
                'news_title' => $faker->sentence,
                'news_content' => $faker->paragraph(20),
            ]);
        }
    }
}
