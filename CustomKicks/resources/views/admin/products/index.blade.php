@extends('layouts.app')

@section('title', 'Admin - Products')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('admin/products.management') }}</span>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">{{ __('admin/products.add_new') }}</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('admin/products.id') }}</th>
                                    <th>{{ __('admin/products.image') }}</th>
                                    <th>{{ __('admin/products.name') }}</th>
                                    <th>{{ __('admin/products.brand') }}</th>
                                    <th>{{ __('admin/products.price') }}</th>
                                    <th>{{ __('admin/products.size') }}</th>
                                    <th>{{ __('admin/products.quantity') }}</th>
                                    <th>{{ __('admin/products.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewData['products'] as $product)
                                    <tr>
                                        <td>{{ $product->getId() }}</td>
                                        <td>
                                            @if($product->getImage())
                                                <img src="{{ asset('storage/' . $product->getImage()) }}" 
                                                     alt="{{ $product->getName() }}" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                {{ __('admin/products.no_image') }}
                                            @endif
                                        </td>
                                        <td>{{ $product->getName() }}</td>
                                        <td>{{ $product->getBrand() }}</td>
                                        <td>${{ number_format($product->getPrice(), 2) }}</td>
                                        <td>{{ $product->getSize() }}</td>
                                        <td>{{ $product->getQuantity() }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.products.edit', $product->getId()) }}" 
                                                   class="btn btn-sm btn-primary">{{ __('admin/products.edit') }}</a>
                                                <a href="{{ route('admin.products.destroy', $product->getId()) }}" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('{{ __('admin/products.delete_confirm') }}')">{{ __('admin/products.delete') }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 