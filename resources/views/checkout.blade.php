@extends('layout.cmaster')

@section('content')
<div class="container">
    <h2 class="text-center">Checkout</h2>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <table class="table table-bordered text-white" style="background-color: black;">
            <tr>
                <!-- 1️⃣ User Details Section -->
                <td style="width: 33%; vertical-align: top;">
                    <h4>User Details</h4>
                    <label>Full Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" required>
                    
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" required>
                    
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $user->phone ?? '' }}" required>
                    
                    <label>Address</label>
                    <textarea class="form-control" name="address" rows="2" required></textarea>
                </td>

                <!-- 2️⃣ Total Price Section -->
                <td style="width: 33%; vertical-align: top;">
                    <h4>Order Summary</h4>
                    <table class="table table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        @php $total = 0; @endphp
                        @foreach(session('cart', []) as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        @endforeach
                        <tr>
                            <th colspan="2">Total Price</th>
                            <th>${{ $total }}</th>
                        </tr>
                    </table>
                </td>

                <!-- 3️⃣ Payment Section -->
                <td style="width: 33%; vertical-align: top;">
                    <h4>Payment Method</h4>
                    <select class="form-control" name="payment" id="paymentMethod" required>
                        <option value="cod">Cash on Delivery</option>
                        <option value="card">Credit/Debit Card</option>
                        <option value="upi">UPI</option>
                    </select>

                    <!-- Card Fields -->
                    <div id="cardFields" class="payment-section" style="display: none; margin-top: 10px;">
                        <label>Card Number</label>
                        <input type="text" class="form-control" name="card_number" pattern="\d{16}" placeholder="16-digit card number">
                        
                        <!-- Expiry Date Field -->
                        <label>Expiry Date (MM/YY)</label>
                        <input type="text" class="form-control" name="card_expiry" id="cardExpiry" placeholder="MM/YY" maxlength="5">
                        
                        <label>CVV</label>
                        <input type="text" class="form-control" name="card_cvv" pattern="\d{3}" placeholder="3-digit CVV">
                    </div>

                    <!-- UPI Fields -->
                    <div id="upiFields" class="payment-section" style="display: none; margin-top: 10px;">
                        <label>UPI ID</label>
                        <input type="text" class="form-control" name="upi_id" placeholder="Enter your UPI ID">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Place Order</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    document.getElementById('paymentMethod').addEventListener('change', function () {
        let cardFields = document.getElementById('cardFields');
        let upiFields = document.getElementById('upiFields');

        cardFields.style.display = this.value === 'card' ? 'block' : 'none';
        upiFields.style.display = this.value === 'upi' ? 'block' : 'none';
    });
    document.getElementById('cardExpiry').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters

        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }

        e.target.value = value.substring(0, 5); // Max length 5 (MM/YY)
    });

</script>

@endsection
