
@extends('layouts.app')

@section('title', 'store')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Success</div>
                <div class="card-body">
                    <p class="text-success">Item añadido !</p>
                    <a href="{{ route('items.index') }}" class="btn btn-primary">volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection