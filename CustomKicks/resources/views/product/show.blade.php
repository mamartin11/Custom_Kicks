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
                        @if(!in_array($key, ['id','image','created_at', 'updated_at']))
                            <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</p>
                        @endif
                    @endforeach
                </p>
                    <a href="{{ route('customizations.select') }}" class="btn btn-dark me-2">
                        Select customization
                    </a>
            </div>
        </div>
    </div>
</div>

@endsection
