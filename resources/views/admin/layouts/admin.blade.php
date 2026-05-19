<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row min-vh-100">
        {{-- SIDEBAR --}}
        <div class="col-md-2 bg-dark text-white p-0">
            @include('admin._partials.sidebar')
        </div>

        {{-- RIGHT CONTENT --}}
        <div class="col-md-10 d-flex flex-column p-0">
            {{-- HEADER --}}
            <div class="border-bottom bg-white">
                @include('admin._partials.header')
            </div>
            {{-- MAIN CONTENT --}}
            <main class="flex-grow-1 bg-light p-3">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <footer class="bg-dark text-white text-center py-2">
                @include('admin._partials.footer')
            </footer>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
