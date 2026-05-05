<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin  - Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container input {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .login-container button {
            background: #ff6f61;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container button:hover {
            background: #e05548;
        }
        .login-container a {
            color: #ff6f61;
            text-decoration: none;
            font-size: 14px;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to Admin Panel</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" value ="admin@admin.com" placeholder="Email Address" required>
            <input type="password" name="password" value="admin@123" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="{{ route('password.request') }}">Forgot Your Password?</a><a href="{{url('signup')}}" ><span style="color:blue;">Create Account</span></a>
        <div class="footer">
            &copy; {{ date('Y') }} World Travel Leads All rights reserved.
        </div>
    </div>
</body>
</html>
