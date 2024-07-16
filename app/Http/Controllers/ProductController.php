<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function new(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            DB::table('products')->insert([
                'name' => $validatedData['name'],
                'description' => $validatedData['description']
            ]);

            return redirect('/products')->with('status', 'Product saved');
            
        } catch (\Throwable $th) {
            \Log::error($th);

            return redirect('/products')->with('error', 'Failed saving the product');
        }
        
    }

    public function delete(Request $request)
    {

        try {

            $validatedData = $request->validate([
                'id' => 'required|integer|exists:products,id',
            ]);
    
            DB::table('products')->where('id', $validatedData['id'])->delete();

            return redirect('/products')->with('status', 'Product was deleted');
            
        } catch (\Throwable $th) {
            \Log::error($th);
        }
        
    }
}
