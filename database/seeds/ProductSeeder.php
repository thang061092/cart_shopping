<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product= new Product();
        $product->name = 'Ip XS Max';
        $product->desc = 'la dong dien thoai moi sang trong, dep mat';
        $product->slug = Str::slug('Ip XS Max');
        $product->price = '13000000';
        $product->image = 'storage/images/ipXS.jpg';
        $product->quantity = '10';
        $product->save();

        $product= new Product();
        $product->name = 'OPPO';
        $product->desc = 'la dong dien thoai moi sang trong, dep mat';
        $product->slug = Str::slug('OPPO');
        $product->price = '9000000';
        $product->image = 'storage/images/oppo.jpg';
        $product->quantity = '10';
        $product->save();

        $product= new Product();
        $product->name = 'Xiaomi';
        $product->desc = 'la dong dien thoai moi sang trong, dep mat';
        $product->slug = Str::slug('Xiaomi');
        $product->price = '5000000';
        $product->image = 'storage/images/xiaomi.jpg';
        $product->quantity = '10';
        $product->save();
    }
}
