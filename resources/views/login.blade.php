@extends('layout.cmaster')  
@section('content')

<div class="container">
    <div class="login-container">
        <form action="" method="POST" name="login">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <table>
                <tr>
                    <th colspan="2"><h4>Login Page</h4></th>
                </tr>
                <tr>
                    <td><input type="text" id="username" name="username" placeholder="Username" required></td>
                </tr>
                <tr>
                    <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit" name="Login">Login</button>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; color: white;">
                        Don't have an account?  
                        <a class="navbar-brand" href="{{route('register')}}" style="color: white; text-decoration: underline;">Register</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(10vh - 60px); /* Proper height to center between navbar & footer */
    }

    .login-container {
        background: rgba(0, 0, 0, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        color: white; /* Set text color to white */
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
        background-color: black;
        color: white;
        cursor: pointer;
        transition: 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Ensuring all text inside login-container is white */
    .login-container h4, 
    .login-container label, 
    .login-container td {
        color: white;
    }

    /* Making sure the register link is white */
    .login-container a {
        color:blue;
        text-decoration: underline;
    }

    .login-container a:hover {
        color: #ddd; /* Slightly lighter color on hover */
    }
</style>

@endsection
