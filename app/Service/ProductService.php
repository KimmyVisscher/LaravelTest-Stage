<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function createProduct(array $data) 
    {
        return DB::table('products')->insert([
            'name'=> $data['name'],
            'description'=> $data['description']
        ]);
    }

    public function deleteProduct(int $id)
    {
        return DB::table('products')->where('id', $id)->delete();
    }
}
