<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Web Monitoring SPPD</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="/js/script.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/css/style.css">

        @yield('header')

    </head>
    <body class="d-flex flex-column min-vh-100">

        @include('partials.navbar')

        @yield('container')

        @include('partials.footer')

        @yield('script')

    </body>
</html>