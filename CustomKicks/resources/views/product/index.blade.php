@extends('layouts.app')

@section('title', __('productIndex.title'))

@section('subtitle', __('productIndex.subtitle'))

@section('content')


<form method="GET" action="{{ route('product.index') }}" class="mb-4">
    <div class="row">

        <!-- Min Price -->
        <div class="col-md-2">
            <input type="number" name="min_price" class="form-control" placeholder={{ __('productIndex.placeholder_minprice') }} 
                value="{{ request()->input('min_price') }}">
        </div>

        <!-- Max Price -->
        <div class="col-md-2">
            <input type="number" name="max_price" class="form-control" placeholder={{ __('productIndex.placeholder_maxprice') }} 
                value="{{ request()->input('max_price') }}">
        </div>

        <!-- Size -->
        <div class="col-md-2">
            <input type="float" name="size" class="form-control" placeholder={{ __('productIndex.placeholder_size') }} 
                value="{{ request()->input('size') }}">
        </div>

        <!-- Brand -->
        <div class="col-md-2">
            <select name="brand" class="form-control">
                <option value="">{{ __('productIndex.placeholder_brand') }}</option>
                @foreach ($viewData["brands"] as $brand)
                    <option value="{{ $brand }}" {{ request()->input('brand') == $brand ? 'selected' : '' }}>
                        {{ $brand }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter button -->
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">{{ __('productIndex.filter_button') }}</button>
        </div>
    </div>
</form>

<div class="row">
    @foreach ($viewData["products"] as $product)
        <div class="col-md-4 col-lg-3 mb-3">
            <div class="card text-center">
                <!-- Nombre del producto en la parte superior -->
                <h5 class="card-header">{{ $product->getName() }}</h5>

                <!-- Imagen del producto almacenada en la base de datos -->
                <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top img-fluid" style="object-fit: contain; height: 200px;">

                <div class="card-body">
                    
                    
                    <!-- Botón con el precio del producto -->
                    <a href="{{ route('item.show', $product->getId()) }}" class="btn btn-primary">
                        ${{ number_format($product->getPrice(), 2) }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
