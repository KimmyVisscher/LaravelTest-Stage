<?php

namespace App\Http\Controllers;

use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('products.index');
    }

    public function new(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string|max:1000',
        ]);

        try {

            $this->productService->createProduct($validatedData);

            return redirect('/products')->with('status', 'Product saved');
            
        } catch (\Throwable $th) {
            \Log::error($th);

            return redirect('/products')->with('error', 'Failed saving the product');
        }
        
    }

    public function delete(Request $request)
    {

        $validatedData = $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        try {

           $this->productService->deleteProduct($validatedData['id']);
            
            return redirect('/products')->with('status', 'Product was deleted');
            
        } catch (\Throwable $th) {
            \Log::error($th);
        }
        
    }
}
