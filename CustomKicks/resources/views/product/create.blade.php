@extends('layouts.app')

@section('title', content: __('product/create.title'))

@section('subtitle', content: __('product/create.subtitle'))


@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __('product/create.form_title') }}</div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <ul id="errors" class="alert alert-danger list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('product.save') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="text" class="form-control mb-2" placeholder={{ __('product/create.placeholder_name') }} name="name" value="{{ old('name') }}" />
                        <input type="text" class="form-control mb-2" placeholder={{ __('product/create.placeholder_price') }} name="price" value="{{ old('price') }}" />
                        <input type="text" class="form-control mb-2" placeholder={{ __('product/create.placeholder_description') }} name="description" value="{{ old('description') }}" />
                        <input type="text" class="form-control mb-2" placeholder={{ __('product/create.placeholder_brand') }} name="brand" value="{{ old('brand') }}" />
                        <input type="text" class="form-control mb-2" placeholder={{ __('product/create.placeholder_size') }} name="size" value="{{ old('size') }}" />
                        <input type="text" class="form-control mb-2" placeholder={{ __('product/create.placeholder_quantity') }} name="quantity" value="{{ old('quantity') }}" />
                        <input type="file" class="form-control mb-2" name="image" />

                        <input type="submit" class="btn btn-primary" value={{ __('product/create.button') }} />
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
