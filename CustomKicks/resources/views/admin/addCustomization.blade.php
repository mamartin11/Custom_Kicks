@extends('layouts.app')

@section('content')
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('adminCustomizationAdd.add_customization') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">{{ __('adminCustomizationAdd.add_customization') }}</h2>

                <form action="{{ route('admin.customizations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">{{ __('adminCustomizationAdd.color') }}:</label>
                        <input type="text" name="color" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('adminCustomizationAdd.design') }}:</label>
                        <input type="text" name="design" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('adminCustomizationAdd.pattern') }}:</label>
                        <input type="text" name="pattern" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('adminCustomizationAdd.image') }}:</label>
                        <input type="file" name="image" accept="image/*" required class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">{{ __('adminCustomizationAdd.save_button') }}</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
@endsection
