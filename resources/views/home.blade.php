@extends('layout.cmaster')

@section('content')
@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@elseif (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<style>
    body {
        margin: 0;
        padding: 0;
    }
    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 40px; /* Move products closer to navbar */
        padding: 10px;
    }
    .product-card {
        width: 200px;
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background-color: black; /* Black background */
        color: white; /* White text */
    }
    .product-card h3,
    .product-card p {
        color: white; /* Ensure all text is white */
    }

    .product-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
    }
    .product-card h3 {
        font-size: 18px;
        margin: 10px 0;
    }
    .product-card p {
        margin: 5px 0;
        font-size: 16px;
    }
    .quantity-input {
        width: 50px; /* Fixed width */
        height: 30px; /* Fixed height */
        text-align: center;
        font-size: 16px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid white;
        background: white;
        color: black;
    }
    .add-to-cart {
        background-color: rgb(9, 14, 10);
        color: white;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }
    .add-to-cart:hover {
        background-color: rgb(4, 7, 177);
    }
</style>

<div class="product-container">
    @foreach ($products as $product)
        <div style="background: black; color: white; padding: 15px; border-radius: 10px; text-align: center; width: 200px;">
            <img src="{{ asset($product->image) }}" width="100">
            <p><strong>{{ $product->name }}</strong></p>
            <p>₹{{ $product->price }}</p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <input type="number" name="quantity" class="quantity-input" value="0" min="0">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
