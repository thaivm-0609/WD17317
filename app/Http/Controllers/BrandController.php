<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::get(); //lay du lieu tu bang brand

        return view('brand.index', ['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {

        $name = $request->input('name'); //lay name tu request form gui len
        $description = $request->input('description'); //lay description tu request form gui len

        $logo = $request->file('logo')->getClientOriginalName(); //lay ten file
        $request->file('logo')->storeAs('public/images', $logo); //luu file vao duong dan public/images voi ten $logo

        //tao data de luu vao db
        $data = [
            'name' => $name,
            'description' => $description,
            'logo' => $logo,
        ];

        Brand::create($data); //tao ban ghi co du lieu la $data
        
        return redirect()->route('brand.index')
            ->with('success','Brand has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $name = $request->input('name'); // lay input name moi
        $description = $request->input('description'); //lay input description moi
        $brand->fill([
            'name' => $name,
            'description' => $description,
        ])->save();

        if ($request->file('logo') !== null) {
            $logo = $request->file('logo')->getClientOriginalName(); //lay ten file
            $request->file('logo')->storeAs('public/images', $logo); //luu file vao duong dan public/images voi ten $logo
        
            $brand->fill([
                'logo' => $logo,
            ])->save();
        }

        return redirect()->route('brand.index')
            ->with('success', 'Brand update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brand.index')
            ->with('success', 'Delete brand successfully');
    }
}
