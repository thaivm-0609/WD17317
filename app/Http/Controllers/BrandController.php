<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all(); //lay du lieu tu bang brand

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
        $logo = $request->file('logo')->getClientOriginalName();
        if ($logo !== $brand->logo) {
            $request->file('logo')->storeAs('public/images', $logo);
            Storage::delete('public/images/'.$brand->logo);
        }

        $brand->fill([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'logo' => $logo,
        ])->save();

        return redirect()->route('brand.index')
            ->with('success','Brand has been update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $logo = $brand->logo;
        Storage::delete('public/images/'.$logo);
        $brand->delete();

        return redirect()->route('brand.index')
            ->with('success','Brand has been deleted successfully');
    }
}
