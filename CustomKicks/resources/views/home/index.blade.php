@extends('layouts.app')

@section('title', 'Home Page - Online Store')

@section('content')

<div class="container my-4">

    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('product.create') }}" class="btn bg-secondary mx-2">Upload a product</a>
        <a href="{{ route('product.index') }}" class="btn bg-secondary mx-2">Product list</a>
    </div>

    @yield('content')

</div>

@endsection