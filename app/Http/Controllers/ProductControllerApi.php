<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $gender = $request->input('gender');
        $price = $request->input('price');
        $description = $request->input('description');
        $brandId = $request->input('brand_id');
        $categoryId = $request->input('category_id');

        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images', $image);

        $data = [
            'name' => $name,
            'gender' => $gender,
            'price' => $price,
            'image' => $image,
            'description' => $description,
            'brand_id' => $brandId,
            'category_id' => $categoryId,
        ];

        $product = Product::create($data); 

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $name = $request->input('name');
        $gender = $request->input('gender');
        $price = $request->input('price');
        $description = $request->input('description');
        $brandId = $request->input('brand_id');
        $categoryId = $request->input('category_id');

        $image = $request->hasFile('image')?$request->file('image')->getClientOriginalName():$product->image;
        if($image){
            $request->file('image')->storeAs('public/images', $image);
        }
        $data = [
            'name' => $name,
            'gender' => $gender,
            'price' => $price,
            'image' => $image,
            'description' => $description,
            'brand_id' => $brandId,
            'category_id' => $categoryId,
        ];

        $product->update($data);
        return response()->json([
            "massage"=>'Update success',
            $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image = $product->image;
        Storage::delete('public/images/'.$image); //xoa file cu
        $product->delete();

        return response()->json(['message' => 'Delete successfully']);
    }
}
