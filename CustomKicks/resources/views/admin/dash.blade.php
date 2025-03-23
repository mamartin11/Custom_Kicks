@extends('layouts.app')

@section('content')
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('adminProductDashboard.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.customizations.dashboard') }}" class="btn btn-primary me-2">{{ __('adminProductDashboard.crud_customizations') }}</a>
            <a href="{{ route('admin.dash') }}" class="btn btn-primary">{{ __('adminProductDashboard.crud_products') }}</a>
        </div>

        <h2 class="text-center">{{ __('adminProductDashboard.title') }}</h2>
        <p class="text-center">{{ __('adminProductDashboard.subtitle') }}</p>

        <a href="{{ route('product.create') }}" class="btn btn-success mb-3">{{ __('adminProductDashboard.add_customization') }}</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('adminProductDashboard.id') }}</th>
                    <th>{{ __('adminProductDashboard.name') }}</th>
                    <th>{{ __('adminProductDashboard.image') }}</th>
                    <th>{{ __('adminProductDashboard.price') }}</th>
                    <th>{{ __('adminProductDashboard.size') }}</th>
    
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['products'] as $product)
                <tr>
                    <td>{{ $product->getId() }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td><img src="{{ asset('storage/' . $product->getImage()) }}" alt="Product" style="width: 100px;"></td>
                    <td>{{ $product->getPrice() }}</td>
                    <td>{{ $product->getSize() }}</td>
                    <td>
                        <a href="{{ route('product.edit', $product->getId()) }}" class="btn btn-warning btn-sm">{{ __('adminProductDashboard.edit') }}</a>
                        <a href="{{ route('product.destroy', $product->getId()) }}" class="btn btn-danger btn-sm">{{ __('adminProductDashboard.delete') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>
@endsection('content')
