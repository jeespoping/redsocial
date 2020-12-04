<?php

use Illuminate\Database\Seeder;
use App\Court;
use App\Category;

class CourtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('courts');
        Court::truncate();
        Category::truncate();

        $category = new Category();
        $category->name = "Publica";
        $category->save();

        $category = new Category();
        $category->name = "Privada";
        $category->save();

        $court = new Court();
        $court->title = "Comfenalco";
        $court->url = str_slug($court->title);
        $court->body = "<p>Quisque congue lacus mattis massa luctus, nec hendrerit purus aliquet. Ut ac elementum urna. Pellentesque suscipit metus et egestas congue. Duis eu pellentesque turpis, ut maximus metus. Sed ultrices tellus vitae rutrum congue. Fusce luctus augue id nisl suscipit, vel sollicitudin orci egestas.</p> <p> Morbi posuere venenatis ipsum, ac vestibulum quam dignissim efficitur. Ut vitae rutrum augue, in volutpat quam. Cras a viverra ipsum. Aenean ut consequat ex, vitae vulputate nunc. Vestibulum metus nisi, aliquam sed tincidunt sit amet, pretium et augue.</p>";
        $court->category_id = 1;
        $court->user_id = 3;
        $court->save();

        $court = new Court();
        $court->title = "Brasilera";
        $court->url = str_slug($court->title);
        $court->body = "<p>Quisque congue lacus mattis massa luctus, nec hendrerit purus aliquet. Ut ac elementum urna. Pellentesque suscipit metus et egestas congue. Duis eu pellentesque turpis, ut maximus metus. Sed ultrices tellus vitae rutrum congue. Fusce luctus augue id nisl suscipit, vel sollicitudin orci egestas.</p> <p> Morbi posuere venenatis ipsum, ac vestibulum quam dignissim efficitur. Ut vitae rutrum augue, in volutpat quam. Cras a viverra ipsum. Aenean ut consequat ex, vitae vulputate nunc. Vestibulum metus nisi, aliquam sed tincidunt sit amet, pretium et augue.</p>";
        $court->category_id = 2;
        $court->user_id = 1;
        $court->cost = 50000;
        $court->save();

        $court = new Court();
        $court->title = "Cedi";
        $court->url = str_slug($court->title);
        $court->body = "<p>Quisque congue lacus mattis massa luctus, nec hendrerit purus aliquet. Ut ac elementum urna. Pellentesque suscipit metus et egestas congue. Duis eu pellentesque turpis, ut maximus metus. Sed ultrices tellus vitae rutrum congue. Fusce luctus augue id nisl suscipit, vel sollicitudin orci egestas.</p> <p> Morbi posuere venenatis ipsum, ac vestibulum quam dignissim efficitur. Ut vitae rutrum augue, in volutpat quam. Cras a viverra ipsum. Aenean ut consequat ex, vitae vulputate nunc. Vestibulum metus nisi, aliquam sed tincidunt sit amet, pretium et augue.</p>";
        $court->category_id = 2;
        $court->user_id = 1;
        $court->cost = 40000;
        $court->save();

    }
}
