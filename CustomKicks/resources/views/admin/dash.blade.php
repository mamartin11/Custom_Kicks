@extends('layouts.app')
<!-- Miguel -->
@section('content')
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('admin/dash.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.customizations.dashboard') }}" class="btn btn-primary me-2">{{ __('admin/dash.crud_customizations') }}</a>
            <a href="{{ route('admin.dash') }}" class="btn btn-primary">{{ __('admin/dash.crud_products') }}</a>
        </div>

        <h2 class="text-center">{{ __('admin/dash.title') }}</h2>
        <p class="text-center">{{ __('admin/dash.subtitle') }}</p>

        <a href="{{ route('product.create') }}" class="btn btn-success mb-3">{{ __('admin/dash.add_customization') }}</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('admin/dash.id') }}</th>
                    <th>{{ __('admin/dash.name') }}</th>
                    <th>{{ __('admin/dash.image') }}</th>
                    <th>{{ __('admin/dash.price') }}</th>
                    <th>{{ __('admin/dash.size') }}</th>
    
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
                        <a href="{{ route('product.edit', $product->getId()) }}" class="btn btn-warning btn-sm">{{ __('admin/dash.edit') }}</a>
                        <a href="{{ route('product.destroy', $product->getId()) }}" class="btn btn-danger btn-sm">{{ __('admin/dash.delete') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>
@endsection('content')
