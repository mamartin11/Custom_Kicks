@extends('layouts.app')

@section('title', $viewData["title"])

@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $viewData['product']->getImage()) }}" class="img-fluid rounded-start" alt="Product Image">
        </div>

        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $viewData["product"]->getName() }}
                </h5>

                <p class="card-text">
                    @foreach($viewData["product"]->getAttributes() as $key => $value)
                        @if(!in_array($key, ['image','created_at', 'updated_at']))
                            <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</p>
                        @endif
                    @endforeach
                </p>

                <div class="d-flex">
                    <a href="{{ route('product.edit', ['id' => $viewData['product']->getID()]) }}" class="btn btn-warning me-2">
                        Edit Product
                    </a>

                    <a href="{{ route('customizations.select') }}" class="btn btn-warning me-2">
                        Select customization
                    </a>

                <form action="{{ route('product.destroy', ['id' => $viewData['product']->getID()]) }}" method="POST">
                    @csrf
                    @method('DELETE') 
                    <button type="submit" class="btn btn-danger">Delete product</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
