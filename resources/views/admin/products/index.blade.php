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
        .img-thumbnail {
    max-width: 100px; /* Adjust width as needed */
    max-height: 100px; /* Adjust height as needed */
    object-fit: cover; /* Ensures the image covers the dimensions without distortion */
}
        .container {
            margin-top: 80px; /* Add margin-top to move the content down */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="color:black" href="{{ route('admin.products') }}">Products</a>
                </li>
                <li class="nav-item">
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="nav-link btn btn-link" style="color:black;">Logout</button>
    </form>
</li>        
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <h1>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>৳{{ $product->price }}</td>
                        <td>
    <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail">
</td>
 <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    document.getElementById('logout-form').addEventListener('submit', function(event) {
        event.preventDefault();
        this.submit();
    });
</script>
</body>

</html>
