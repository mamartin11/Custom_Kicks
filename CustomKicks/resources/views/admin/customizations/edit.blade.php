@extends('layouts.app')

@section('title', 'Edit Customization')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Customization</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.customizations.update', $customization->getId()) }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="color" class="col-md-4 col-form-label text-md-right">Color</label>
                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $customization->getColor() }}" required>
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="design" class="col-md-4 col-form-label text-md-right">Design</label>
                            <div class="col-md-6">
                                <input id="design" type="text" class="form-control @error('design') is-invalid @enderror" name="design" value="{{ $customization->getDesign() }}" required>
                                @error('design')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="pattern" class="col-md-4 col-form-label text-md-right">Pattern</label>
                            <div class="col-md-6">
                                <input id="pattern" type="text" class="form-control @error('pattern') is-invalid @enderror" name="pattern" value="{{ $customization->getPattern() }}" required>
                                @error('pattern')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Customization
                                </button>
                                <a href="{{ route('admin.customizations.dashboard') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 