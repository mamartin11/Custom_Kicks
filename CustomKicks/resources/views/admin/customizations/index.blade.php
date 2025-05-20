@extends('layouts.app')

@section('title', 'Admin - Customizations')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Customization Management</span>
                    <a href="{{ route('admin.customizations.add') }}" class="btn btn-sm btn-primary">Add New</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Color</th>
                                    <th>Design</th>
                                    <th>Pattern</th>
                                    <th>Image</th>
                                    <th>Actions</th>
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
                                            @if($customization->getImage())
                                                <img src="{{ asset('storage/' . $customization->getImage()) }}" 
                                                     alt="Customization" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.customizations.edit', $customization->getId()) }}" 
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('admin.customizations.delete', $customization->getId()) }}" 
                                                   class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this customization?')">Delete</a>
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