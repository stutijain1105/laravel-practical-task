<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Auth System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f6f6;
            text-align: center;
            padding-top: 100px;
        }
        .container {
            width: 40%;
            margin: auto;
        }
        a.btn {
            display: block;
            padding: 15px;
            margin: 15px 0;
            background: #4a90e2;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
        }
        a.btn:hover {
            background: #357ABD;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Multi Auth System</h1>
    <p>Select an option below:</p>

    <a href="{{ url('customer/register') }}" class="btn">Customer Register</a>
    <a href="{{ url('admin/register') }}" class="btn">Admin Register</a>
    <a href="{{ url('admin/login') }}" class="btn">Admin Login</a>
</div>

</body>
</html>
