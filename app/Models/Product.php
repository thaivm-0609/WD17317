<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'price',
        'image',
        'description',
        'brand_id',
        'category_id',
    ];

    public function brand() //tạo relationship với model Brand
    {
        return $this->belongsTo(Brand::class);
    }

    public function category() //tạo relationship với model Category
    {
        return $this->belongsTo(Category::class);
    }

    // khai báo scope 
    // public function scopeFemale($query) 
    // {
    //     return $query->where('gender','female');
    // }
    
    // khai báo scope động 
    public function scopeByGender($query, $gender) 
    {
        return $query->where('gender', $gender);
    }
}
