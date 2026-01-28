@extends('layout.amaster')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-white">Product Stock Management</h2>

    <table class="table table-dark table-bordered text-center mt-4">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Total Stock</th>
                <th>Sold</th>
                <th>Remaining Stock</th>
                <th>Update Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <td>
                <img src="{{ asset($product->image) }}" width="60" height="60" alt="Product Image">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td> <!-- Total Stock -->
            <td>{{ $product->sold_quantity }}</td> <!-- Sold Quantity -->
            <td id="remaining_stock_{{ $product->id }}">{{ $product->remaining_stock }}</td> <!-- Current Remaining Stock -->
            <td>
            <input type="number" id="new_stock_{{ $product->id }}" value="{{ $product->remaining_stock }}" class="form-control text-center" style="width: 100px;" required>
            </td>
            <td>
                <a href="#" onclick="updateStock({{ $product->id }})" class="btn btn-success btn-sm mt-2">Update</a>
                <a href="{{ route('stocks.remove', $product->id) }}" class="btn btn-danger btn-sm">Remove</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>

<script>
function updateStock(productId) {
    let newStock = document.getElementById('new_stock_' + productId).value;

    if (newStock !== '' && !isNaN(newStock) && newStock >= 0) {
        window.location.href = `/stocks/update/${productId}/${newStock}`;
    } else {
        alert('Please enter a valid stock value.');
    }
}
</script>

@endsection
