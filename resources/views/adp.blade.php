@extends('layout.amaster')

@section('content')
<div class="form-container">
    <h2>Add Product</h2>

    @if (session('success'))
        <p class="success-msg">{{ session('success') }}</p>
    @elseif (session('error'))
        <p class="error-msg">{{ session('error') }}</p>
    @endif

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td><label for="pn">Product Name:</label></td>
                <td><input type="text" id="pn" name="pn" placeholder="Enter product name" required></td>
            </tr>

            <tr>
                <td><label for="image">Product Image:</label></td>
                <td><input type="file" name="image" id="image" required></td>
            </tr>

            <tr>
                <td><label for="pr">Product Price:</label></td>
                <td><input type="number" id="pr" name="pr" placeholder="Enter price" required></td>
            </tr>

            <tr>
                <td><label for="qty">Quantity:</label></td>
                <td><input type="number" id="qty" name="qty" placeholder="Enter quantity" required></td>
            </tr>

            <tr>
                <td colspan="2" class="center">
                    <button type="submit">Add Product</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<style>
    /* The body background will remain the same as in amaster.blade.php */
    
    /* Center the form container */
    .form-container {
        background: rgba(0, 0, 0, 0.8); /* Single form box */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        width: 400px;
        text-align: center;
        margin: auto;
        margin-top: 80px; /* Keeps spacing under navbar */
    }

    h2 {
        font-size: 20px;
        margin-bottom: 15px;
        color: white;
    }

    /* Success & error messages */
    .success-msg {
        color: green;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .error-msg {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
    }

    /* Table for inputs */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 10px;
        text-align: left;
    }

    label {
        font-size: 14px;
        font-weight: bold;
        color: white;
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
        outline: none;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #007bff;
    }

    /* Center submit button */
    .center {
        text-align: center;
    }

    button {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #0056b3;
    }
</style>
@endsection
