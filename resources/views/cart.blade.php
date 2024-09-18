<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px; /* Space for the fixed navbar */
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
        .cart-title {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .empty-message {
            margin-top: 20px;
        }
        .product-image {
            width: 100px; /* Adjust as needed */
            height: auto;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="/">Shop Sizzle</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Our Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">
                                <i class="fa fa-shopping-cart"></i>
                                Cart (<span>{{ session()->has('cart') ? count(session('cart')) : 0 }}</span>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mt-5">
        <h1 class="cart-title">Your Cart</h1>
        
        @if(Session::has('cart') && count(Session::get('cart')) > 0)
        <table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Actions</th> <!-- Add this -->
        </tr>
    </thead>
    <tbody>
        @foreach (Session::get('cart') as $productId => $details)
            <tr>
                <td>
                    <img src="{{ asset('assets/images/' . $details['image']) }}" alt="{{ $details['name'] }}" class="product-image">
                    {{ $details['name'] }}
                </td>
                <td>৳{{ $details['price'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>৳{{ $details['price'] * $details['quantity'] }}</td>
                <td>
                    <form action="{{ route('cart.remove', $productId) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td> 
                @if(Session::has('cart') && count(Session::get('cart')) > 0)
    <form action="{{ route('cart.confirm') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Confirm Order</button>
    </form>
@endif

            </tr>
        @endforeach
    </tbody>
</table>
        @else
            <p class="empty-message">No items in the cart.</p>
        @endif
    </main>

    <!-- Footer -->
    <footer>
        <p class="mb-0">Copyright © 2024 ShopSizzle</p>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
