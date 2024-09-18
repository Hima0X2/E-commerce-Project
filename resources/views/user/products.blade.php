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

        /* Hide products by default */
        .product-item {
            display: none;
        }

        /* Show products by default (for testing) */
        .show {
            display: block;
        }
    </style>
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

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="filters">
                            <ul>
                                <li class="active" data-filter="*">All Products</li>
                                <li data-filter=".des">Featured</li>
                                <li data-filter=".dev">Flash Deals</li>
                                <li data-filter=".gra">Last Minute</li>
                            </ul>
                        </div>
                    </div>

                   <!-- Display Products -->
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-4 {{ $product->category ?? 'des' }} {{ 'product-' . $product->id }}">
                            <div class="product-item show">
                                <a href="#"><img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}"></a>
                                <div class="down-content">
                                    <a href="#"><h4>{{ $product->name }}</h4></a>
                                    <h6>৳{{ $product->price }}</h6>
                                    <p>Lorem ipsum dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>Reviews (12)</span>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                                        <input type="hidden" name="product_image" value="{{ $product->image }}">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright © 2024 : ShopSizzle</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Click event for filter items
            $('.filters li').click(function() {
                var filter = $(this).data('filter');

                // Remove active class from all filters
                $('.filters li').removeClass('active');
                // Add active class to clicked filter
                $(this).addClass('active');

                if (filter === '*') {
                    // Show all products
                    $('.product-item').parent().show();
                } else {
                    // Hide all products
                    $('.product-item').parent().hide();
                    // Show only filtered products
                    $(filter).parent().show();
                }
            });

            // Show all products on page load if 'All Products' is selected
            $('.filters li.active').click();
        });
    </script>
</body>

</html>
