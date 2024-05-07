<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            ['id' =>1 , 'name' =>'Cameras' , 'description'=>'Electries cameras' , 'imagepath'=>'assets\img\cameras.jpg'],
            ['id' =>2 , 'name' =>'Food' , 'description'=>'Control your food quality' , 'imagepath'=>'assets\img\food.jpg'],
            ['id' =>3 , 'name' =>'Electronic' , 'description'=>'Make your life easier' , 'imagepath'=>'assets\img\electronic.jpg'],
            ['id' =>4 , 'name' =>'Watches' , 'description'=>'Time under control' , 'imagepath'=>'assets\img\horlogjes.jpg'],
            ['id' =>5 , 'name' =>'Bags' , 'description'=>'Your needs by you!' , 'imagepath'=>'assets\img\bags.jpg'],
            ['id' =>6 , 'name' =>'Makeups' , 'description'=>'Paint your style!' , 'imagepath'=>'assets\img\makeups.jpg']
        ];
        DB::table('categories')->insertOrIgnore($categories);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $products = [
            ['id' =>1 , 'name' =>'Durum' , 'description'=>'Vet en ongezond maar lekker!' , 'imagepath'=>'assets\img\durum.jpg' , 'quantity'=>50 , 'price'=>7.00 , 'category_id'=>2],
            ['id' =>2 , 'name' =>'Burger' , 'description'=>'Vet en ongezond maar lekker!' , 'imagepath'=>'assets\img\burger.jpg' , 'quantity'=>50 , 'price'=>7.00 , 'category_id'=>2],
            ['id' =>3 , 'name' =>'Nikon' , 'description'=>'Good quality' , 'imagepath'=>'assets\img\nikon.jpg' , 'quantity'=>60 , 'price'=>75.00 , 'category_id'=>1],
            ['id' =>4 , 'name' =>'Sony' , 'description'=>'Good quality' , 'imagepath'=>'assets\img\sony.jpg' , 'quantity'=>60 , 'price'=>75.00 , 'category_id'=>1],
            ['id' =>5 , 'name' =>'Mobile' , 'description'=>'Good communication' , 'imagepath'=>'assets\img\mobiles.jpg' , 'quantity'=>55 , 'price'=>100.00 , 'category_id'=>3],
            ['id' =>6 , 'name' =>'tv' , 'description'=>'Success and happy wachting.' , 'imagepath'=>'assets\img\tv.jpg' , 'quantity'=>111 , 'price'=>123.00 , 'category_id'=>3],
            ['id' =>7 , 'name' =>'VL' , 'description'=>'Nice and comfortable!' , 'imagepath'=>'assets\img\vl.jpg' , 'quantity'=>25 , 'price'=>45.50 ,  'category_id'=>5],
            ['id' =>8 , 'name' =>'DS' , 'description'=>'Amazing and profissional!' , 'imagepath'=>'assets\img\ds.jpg' , 'quantity'=>25 , 'price'=>45.50 ,  'category_id'=>5],
            ['id' =>9 , 'name' =>'JUDY' , 'description'=>'Rouge that makes your lips sexy!' , 'imagepath'=>'assets\img\judy.jpg' , 'quantity'=>120 , 'price'=>5.00 ,  'category_id'=>6],
            ['id' =>10 , 'name' =>'KOJA' , 'description'=>'An amazing maskara that makes your eyes attractive' , 'imagepath'=>'assets\img\koja.jpg' , 'quantity'=>130 , 'price'=>7.00 ,  'category_id'=>6],
            ['id' =>11 , 'name' =>'Niposi' , 'description'=>'A briliant watche that shows your personality!' , 'imagepath'=>'assets\img\niposi.jpg' , 'quantity'=>100 , 'price'=>85.00 , 'category_id'=>4],
            ['id' =>12 , 'name' =>'Naviforce' , 'description'=>'A good choise to make ypur forcy visible!' , 'imagepath'=>'assets\img\naviforce.jpg' , 'quantity'=>120 , 'price'=>70.00 , 'category_id'=>4]
        ];
        DB::table('products')->insertOrIgnore($products);
    }
}
