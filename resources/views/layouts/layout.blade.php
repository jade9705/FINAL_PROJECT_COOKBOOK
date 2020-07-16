<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cookbook</title>
    <link rel="stylesheet" href="/css/app.css">

    {{-- favicon links --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/cookbookfavicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/cookbookfavicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#353535">
</head>
<body>
    @include('partials.header')
    
    @yield('content')
    
    @include('partials.footer')
    <script>

        setTimeout(()=> {
            const alerts = document.querySelectorAll('.alert');

            var i;
            for (i = 0; i < alerts.length; i++) {
                alerts[i].remove();
            } 

        }, 5000)

    </script>

</body>
</html>