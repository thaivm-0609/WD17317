<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinController extends Controller
{
    function index() {
        return view('tin');
    }

    function detail($id) { //nhận tham số $id từ URL
        $data = [ 'id' => $id ];

        return view('tin', $data); //trả data về view tin.blade.php
    }
}
