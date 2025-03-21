<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('adminCustomizationDashboard.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.customizations.dashboard') }}" class="btn btn-primary me-2">{{ __('adminCustomizationDashboard.crud_customizations') }}</a>
            <a href="#" class="btn btn-primary">{{ __('adminCustomizationDashboard.crud_products') }}</a>
        </div>

        <h2 class="text-center">{{ __('adminCustomizationDashboard.title') }}</h2>
        <p class="text-center">{{ __('adminCustomizationDashboard.subtitle') }}</p>

        <a href="{{ route('admin.customizations.add') }}" class="btn btn-success mb-3">{{ __('adminCustomizationDashboard.add_customization') }}</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('adminCustomizationDashboard.id') }}</th>
                    <th>{{ __('adminCustomizationDashboard.color') }}</th>
                    <th>{{ __('adminCustomizationDashboard.design') }}</th>
                    <th>{{ __('adminCustomizationDashboard.pattern') }}</th>
                    <th>{{ __('adminCustomizationDashboard.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['customizations'] as $customization)
                <tr>
                    <td>{{ $customization->getId() }}</td>
                    <td>{{ $customization->getColor() }}</td>
                    <td>{{ $customization->getDesign() }}</td>
                    <td>{{ $customization->getPattern() }}</td>
                    <td>
                        <a href="{{ route('admin.customizations.edit', $customization->getId()) }}" class="btn btn-warning btn-sm">{{ __('adminCustomizationDashboard.edit') }}</a>
                        <a href="{{ route('admin.customizations.delete', $customization->getId()) }}" class="btn btn-danger btn-sm">{{ __('adminCustomizationDashboard.delete') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
