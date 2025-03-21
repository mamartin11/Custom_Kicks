<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('customizations.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4">
        <h2 class="text-center">{{ __('customizations.title') }}</h2>
        <p class="text-center">{{ __('customizations.subtitle') }}</p>

        @if(session('success'))
            <div class="alert alert-success text-center">
                <p>{{ __('customizations.success') }}</p>
                <p><strong>{{ __('customizations.color') }}:</strong> {{ session('selected_color') }}</p>
                <p><strong>{{ __('customizations.design') }}:</strong> {{ session('selected_design') }}</p>
                <p><strong>{{ __('customizations.pattern') }}:</strong> {{ session('selected_pattern') }}</p>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('customizations.apply') }}" method="POST" class="card p-4 shadow-sm">
                    @csrf
    
                    <div class="mb-3">
                        <label for="id" class="form-label">{{ __('customizations.select_customization') }}</label>
                        <select name="id" class="form-select" required>
                            @foreach($viewData['customizations'] as $customization)
                            <option value="{{ $customization->getId() }}">
                                {{ $customization->getDesign() }} - {{ $customization->getColor() }} - {{ $customization->getPattern() }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{ __('customizations.use_customization') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
