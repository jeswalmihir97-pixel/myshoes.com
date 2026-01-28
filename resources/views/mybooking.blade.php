@extends('layout.cmaster')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">My Bookings</h2>

    @if($orders->isEmpty())
        <p class="text-center">You have no bookings yet.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Payment Method</th>
                        <th>Total Price</th>
                        <th>Purchased Products</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                    <tr>
                        <td><strong>{{ $index + 1 }}</strong></td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td class="text-success">{{ ucfirst($order->payment_method) }}</td>
                        <td class="text-primary"><strong>₹{{ $order->total }}</strong></td>
                        <td>
                            @foreach($order->items as $item)
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset($item->image) }}" width="40" height="40" class="img-thumbnail me-2">
                                <div>
                                    <strong>{{ $item->name }}</strong>
                                    <p class="mb-0">Qty: {{ $item->quantity }} | ${{ $item->price }}</p>
                                </div>
                            </div>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
