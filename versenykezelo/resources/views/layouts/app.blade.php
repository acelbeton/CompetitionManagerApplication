<!DOCTYPE html>
<html>
<head>
    <title>Competition System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/competition.js') }}"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('create-competition') }}">Create Competition</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
