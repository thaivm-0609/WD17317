<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //dùng eloquent để lấy dữ liệu bảng data với scope là byGender
        $products = Product::byGender('male')->get(); 
        //lấy thêm dữ liệu các model Brand/Category dựa vào relation
        $products->load([
            'brand',
            'category',
        ]);
        
        return view('list-products', ['products' => $products]);
    }
}
