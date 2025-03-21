@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('añadir item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('items.store') }}">
                        @csrf

                        <!-- id_product -->
                        <div class="row mb-3">
                            <label for="product_id" class="col-md-4 col-form-label text-md-end">{{ __('product_id') }}</label>

                            <div class="col-md-6">
                                <input id="product_id" type="number" class="form-control @error('product_id') is-invalid @enderror" name="product_id" value="{{ old('product_id') }}" >

                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- costumization_id -->
                        <div class="row mb-3">
                            <label for="costumization_id" class="col-md-4 col-form-label text-md-end">{{ __('costumization_id') }}</label>

                            <div class="col-md-6">
                                <input id="costumization_id" type="number" class="form-control @error('costumization_id') is-invalid @enderror" name="costumization_id" value="{{ old('costumization_id') }}" required autocomplete="costumization_id">

                                @error('costumization_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- order_id -->
                        <div class="row mb-3">
                            <label for="order_id" class="col-md-4 col-form-label text-md-end">{{ __('order_id') }}</label>

                            <div class="col-md-6">
                                <input id="order_id" type="number" class="form-control @error('order_id') is-invalid @enderror" name="order_id" value="{{ old('order_id', 1) }}" required >

                                @error('order_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--subtotal-->
                        <div class="row mb-3">
                            <label for="product_price" class="col-md-4 col-form-label text-md-end">{{ __('product_price') }}</label>

                            <div class="col-md-6">
                                <input id="product_price" type="number" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{ old('product_price', 1) }}"  >

                                @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                    

                        <!-- enviar -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Añadir item') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
