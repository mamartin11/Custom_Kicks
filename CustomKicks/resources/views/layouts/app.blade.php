<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />

    <title>@yield('title', __('layout.title'))</title>

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        
        <a class="navbar-brand" href="{{ route('home.index') }}">{{ __('layout.title')}}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">{{ __('layout.nav_home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dash') }}">{{ __('layout.nav_admin') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">{{ __('layout.nav_products') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('item.list') }}">{{ __('layout.nav_cart') }}</a>
                </li>

                <div class="vr bg-white mx-2 d-none d-lg-block"></div> 
                @guest 
                <a class="nav-link active" href="{{ route('login') }}">{{ __('layout.nav_login') }}</a> 
                <a class="nav-link active" href="{{ route('register') }}">{{ __('layout.nav_register') }}</a> 
                @else 
                <form id="logout" action="{{ route('logout') }}" method="POST"> 
                    <a role="button" class="nav-link active" 
                    onclick="document.getElementById('logout').submit();">{{ __('layout.nav_logout') }}</a> 
                    @csrf 
                </form> 
                @endguest 

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<header class="masthead bg-primary text-black text-center py-4">
    <div class="container d-flex align-items-center flex-column">
        <h2>@yield('subtitle', __('layout.subtitle'))</h2>
    </div>
</header>

<div class="container my-4">
    @yield('content')
</div>

<div class="copyright py-4 text-center text-white">
    <div class="container">
        <small>
            <a class="text-reset fw-bold text-decoration-none" target="_blank">
            {{ __('layout.footer') }}
            </a>
        </small>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

@stack('scripts')
@stack('styles')
</body>
</html>