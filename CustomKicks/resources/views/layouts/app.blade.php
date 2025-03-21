<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
        <title>@yield('title', 'Online Store')</title>
    </head>
    <body>
    <!-- header -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
        </nav>
        <header class="masthead bg-primary text-white text-center py-4">
            <div class="container d-flex align-items-center flex-column">
                <h2>@yield('subtitle', 'A Laravel EAFIT App')</h2>
            </div>
        </header>
        <!-- header -->
        <div class="container my-4">
            @yield('content')
        </div>
        <!-- footer -->
        <div class="copyright py-4 text-center text-white">
            <div class="container">
                <small>
                    Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
                    href="https://twitter.com/danielgarax">
                    Daniel Correa
                    </a>
                </small>
            </div>
        </div>
        <!-- footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
    </body>
</html>
