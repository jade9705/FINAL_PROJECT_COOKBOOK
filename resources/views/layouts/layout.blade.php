<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cookbook</title>
    <link rel="stylesheet" href="/css/app.css">
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