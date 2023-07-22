@extends('layouts.layout')

@section('content')
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
            <th>Brand</th>
            <th>Category</th>
        </tr>

        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->gender }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->image }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->brand->name }}</td>
            <td>{{ $product->category_id }}</td>
        </tr>
        @endforeach
    </table>
@endsection