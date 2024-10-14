<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>ShopSizzle - Product Details</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

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
                        <li class="nav-item active">
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
            </div>
        </nav>
    </header>

    <!-- Product Information -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <!-- Product Image -->
                <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <!-- Product Details -->
                <h1>{{ $product->name }}</h1>
                <h3>৳{{ $product->price }}</h3>
                <p>{{ $product->description }}</p> <!-- Assuming you have a 'description' field -->
                <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="product_name" value="{{ $product->name }}">
    <input type="hidden" name="product_price" value="{{ $product->price }}">
    <input type="hidden" name="product_image" value="{{ $product->image }}">
    <h3>Product ID : {{ $product->id }}</h3><br>
                    <h3>Product Name : {{ $product->name }}</h3><br>
                    <h4>Product description :</h4>
                    <p style="font-size: 1em; font-weight: bold;">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis.
                    </p><br>
                    <h4>Quantity:</h4>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-outline-secondary" id="decrement">-</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control text-center" style="width: 60px;">
                        <button type="button" class="btn btn-outline-secondary" id="increment">+</button>
                    </div>
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content text-center">
                        <p>Copyright © 2024 : ShopSizzle </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Additional Scripts -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>

    <script>
         document.getElementById('add-to-cart-form').onsubmit = function(event) {
        // Check if user is authenticated
        var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        
        if (!isAuthenticated) {
            event.preventDefault(); // Prevent the form from submitting
            alert('Please log in to add items to your cart.'); // Show alert
            window.location.href = "{{ route('login') }}"; // Redirect to login page
        }
    };

        // JavaScript for increment and decrement
        document.getElementById('increment').onclick = function() {
            var quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        };

        document.getElementById('decrement').onclick = function() {
            var quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        };
    </script>

</body>

</html>
