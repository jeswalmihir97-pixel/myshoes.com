@extends('layout.cmaster')  
@section('content')

<div class="container">
    <div class="register-container">
        <form action="{{ route('register.user') }}" method="POST" name="registration">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <table>
                <tr>
                    <th colspan="2"><h3>Register Page</h3></th>
                </tr>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" id="name" name="name" placeholder="Name" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone No:</label></td>
                    <td><input type="tel" id="p_no" name="phone" placeholder="Phone No" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="Email" required></td>
                </tr>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="username" placeholder="Username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit" name="register">Register</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<style>
    /* Centering the content while keeping navbar & footer */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(10vh - 60px); /* Adjust according to navbar & footer */
        padding-top: 0px; /* Space below navbar */
        padding-bottom: 0px; /* Space above footer */
    }

    .register-container {
        background: rgba(18, 18, 20, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        color: white; /* Text color white */
    }

    table {
        width: 100%;
        max-width: 400px;
    }

    input, button {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }

    button {
        background-color:rgb(19, 18, 18);
        color: white;
        cursor: pointer;
        transition: 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Centering text inside the form */
    .register-container h3, 
    .register-container label, 
    .register-container td {
        color: white;
    }
</style>

@endsection
