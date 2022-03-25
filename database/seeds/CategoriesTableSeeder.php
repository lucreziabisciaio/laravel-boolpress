<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["code" => "thriller", "description" => "descrizioone thriller"],
            ["code" => "comedy", "description" => "comedy thriller"],
            ["code" => "action", "description" => "action thriller"],
            ["code" => "fantasy", "description" => "fantasy thriller"],
            ["code" => "adventure", "description" => "adventure thriller"],
            ["code" => "romance", "description" => "romance thriller"]
        ];

        foreach ($categories as $category) {
            $newCat = new Category();
            $newCat->fill($category);
            $newCat->save();
        }
    }
}