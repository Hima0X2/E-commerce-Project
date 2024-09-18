<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>ShopSizzle Products</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Footer always on bottom */
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }
        .containermain {
            padding-top: 80px; 
            flex: 1;
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .product-item img {
            width: 100%; /* Ensures the image fits the container */
            height: auto;
        }
        .product-image {
    width: 150px; /* Adjust the width as needed */
    height: auto; /* Keep the aspect ratio */
    object-fit: cover; /* Cover the image area */
}
.empty-cart-message {
    text-align: center;
    margin: 50px 0;
    padding: 20px;
    font-size: 1.5em;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.empty-cart-message i {
    display: block;
    font-size: 3em;
    color: #007bff; /* Adjust color as needed */
    margin-bottom: 10px;
}

    </style>
</head>
<body>
<!-- Header -->
<header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/"><h2>Shop <em>Sizzle</em></h2></a>
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
                            <li class="nav-item active">
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
            </div>
        </nav>
    </header>

    <div class="containermain">
        <h2>Your Cart</h2>
        @if(is_array($cartItems) && count($cartItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $id => $item)
                        <tr>
                            <td>
                                @if(isset($item['image']))
                                    <img src="{{ asset('assets/images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="product-image">
                                @else
                                    <p>No image available</p>
                                @endif
                                {{ $item['name'] }}
                            </td>
                            <td> ৳{{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td> ৳{{ $item['price'] * $item['quantity'] }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total:  ৳{{ array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cartItems)) }}</h3>
            <form action="{{ route('cart.confirm') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Confirm Order</button>
            </form>
        @else
        <p class="empty-cart-message">
    <i class="fa-solid fa-cart-shopping"></i> <!-- Correct class for FontAwesome 6 -->
    Your cart is empty.
</p>

        @endif
    </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright © 2024 : ShopSizzle </p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        // Display success alert if session has 'success' message
        @if (session('success'))
            alert('{{ session('success') }}');
        @endif
    </script>
</body>
</html>
