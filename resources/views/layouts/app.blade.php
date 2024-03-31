<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="{{ asset('assets/js/jquery-2.1.3.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body class="bg-gray-50 dark:bg-slate-900">
    <!-- ========== MAIN CONTENT ========== -->
    @include('includes.sidebar')

    <!-- Content -->
    <div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:ps-72">
        @yield('content')
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
</body>

</html>
