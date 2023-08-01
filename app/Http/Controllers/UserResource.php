<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get(); //lấy data từ db

        return response()->json($users);
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
        $username = $request->input('name'); //lấy thông tin name từ request
        $email = $request->input('email'); //lấy thông tin email từ request
        $password = bcrypt($request->input('password')); //lấy password từ request
        $data = [
            'name' => $username,
            'email' => $email,
            'password' => $password,
        ];
        $user = User::create($data); //tao ban ghi co du lieu la $data
        
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
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
    public function update(Request $request, User $user)
    {
        $username = $request->input('name'); //lấy thông tin name từ request
        $email = $request->input('email'); //lấy thông tin email từ request
        $password = $request->input('password'); //lấy password từ request
        //update user
        $user->email = $email;
        $user->name = $username;
        $user->password = password_hash($password,PASSWORD_DEFAULT);
        $user->save();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(['message' => 'Delete successful']); //trả về message thông báo
    }
}
