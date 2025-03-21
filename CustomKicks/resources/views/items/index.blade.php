@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $title }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($items->isEmpty())
        <p>No items in the order</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id product</th>
                    <th>Customization_id</th>
                    <th>Order_id</th>
                    <th>subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->customization_id }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
