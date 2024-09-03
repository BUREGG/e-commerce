<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequestForm;
use App\Http\Requests\ProductUpdateRequestForm;
use App\Http\Resources\BaseResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->get();
        return view('welcome', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addproduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequestForm $form): BaseResource
    {
        $product = $form->save();
        return new BaseResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('productdetails', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('productedit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequestForm $form, Product $product)
    {
        $product = $form->save();
        return new BaseResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();    
    }
}
