@extends('layout.cmaster')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Invoice #{{ $order->id }}</h2>
    <p class="text-muted">Order Date: {{ $order->created_at->format('d M, Y') }}</p>

    <div class="row">
        <!-- Customer Details -->
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <h4 class="text-primary">Customer Details</h4>
                <p><strong>Name:</strong> {{ $order->name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
            </div>
        </div>
        <!-- Payment Details -->
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <h4 class="text-danger">Payment Details</h4>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                <h3 class="text-dark mt-3"><strong>Total:</strong> ₹{{ $order->total }}</h3>
            </div>
        </div>

        <!-- Purchased Products -->
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <h4 class="text-success">Purchased Products</h4>
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr>
                            <td><img src="{{ asset($item->image) }}" width="50" height="50" class="img-thumbnail"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
