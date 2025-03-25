@extends('layouts.app')
<!-- Nicolas -->
@section('content')

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('admin/editCustomization.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">{{ __('admin/editCustomization.title') }}</h2>
                <form action="{{ route('admin.customizations.update', $customization->getId()) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ __('admin/editCustomization.color') }}:</label>
                        <input type="text" name="color" class="form-control" value="{{ $customization->getColor() }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('admin/editCustomization.design') }}:</label>
                        <input type="text" name="design" class="form-control" value="{{ $customization->getDesign() }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('admin/editCustomization.pattern') }}:</label>
                        <input type="text" name="pattern" class="form-control" value="{{ $customization->getPattern() }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">{{ __('admin/editCustomization.update_button') }}</button>
                </form>
            </div>
        </div>
    </div>

</body>
@endsection('content')
