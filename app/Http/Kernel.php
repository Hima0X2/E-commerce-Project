<?php
// app/Http/Kernel.php

 $routeMiddleware = [
    // Other middleware
    'auth.admin' => \App\Http\Middleware\RedirectIfNotAuthenticated::class,
];
