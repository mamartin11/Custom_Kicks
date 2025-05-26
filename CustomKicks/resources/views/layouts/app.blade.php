<!doctype html>
<!-- Miguel-->
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />

    <title>@yield('title', __('layout/app.title'))</title>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        
        <a class="navbar-brand" href="{{ route('home.index') }}">{{ __('layout/app.title')}}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">{{ __('layout/app.nav_home') }}</a>
                </li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.dashboard') }}">{{ __('layout/app.nav_admin') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.my-orders') }}">{{ __('layout/app.nav_my_orders') }}</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">{{ __('layout/app.nav_products') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.list') }}">{{ __('layout/app.nav_cart') }}</a>
                </li>




                @if(isset($usdToCop))
                    <li class="nav-item text-white d-flex align-items-center ms-3">
                        <span class="nav-link disabled text-success fw-bold">
                            USD → COP: <strong>{{ number_format($usdToCop, 2) }}</strong>
                        </span>
                    </li>
                @endif

                <div class="vr bg-white mx-2 d-none d-lg-block"></div> 
                @guest 
                <a class="nav-link active" href="{{ route('login') }}">{{ __('layout/app.nav_login') }}</a> 
                <a class="nav-link active" href="{{ route('register') }}">{{ __('layout/app.nav_register') }}</a> 
                @else 
                <form id="logout" action="{{ route('logout') }}" method="POST"> 
                    <a role="button" class="nav-link active" 
                    onclick="document.getElementById('logout').submit();">{{ __('layout/app.nav_logout') }}</a> 
                    @csrf 
                </form> 
                @endguest 

            </ul>
        </div>
    </div>
</nav>

<header class="masthead bg-primary text-black text-center py-4">
    <div class="container d-flex align-items-center flex-column">
        <h2>@yield('subtitle', __('layout/app.subtitle'))</h2>
    </div>
</header>

<div class="container my-4">
    @yield('content')
</div>

<div class="copyright py-4 text-center text-white">
    <div class="container">
        <small>
            <a class="text-reset fw-bold text-decoration-none" target="_blank">
            {{ __('layout/app.footer') }}
            </a>
        </small>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

@stack('scripts')
@stack('styles')
</body>
</html>