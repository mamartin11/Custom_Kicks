@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $viewData['title'] }}</h1>
    <h2>{{ $viewData['subtitle'] }}</h2>
    
    <div class="card">
        <div class="card-body">
            <h3>{{ $viewData['product']->name }}</h3>
            <p>Brand: {{ $viewData['product']->brand }}</p>
            <p>Price: ${{ number_format($viewData['product']->price, 2) }}</p>
            <p>Size: {{ $viewData['product']->size }}</p>
        </div>
    </div>

    <<a href="{{ route('spin.wheel.start', ['id' => $viewData['product']->id]) }}" class="btn btn-success mt-3">
    ¡Girar Ruleta de Descuentos!
    </a>
</div>


</script>
@endsection
