<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Knowbees Consulting Cataloging Tool</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-8"> 
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/functions.js"></script> 
    <link rel="shortcut icon" type="image/png" href="http://knowbees.in/wp-content/uploads/2018/04/cropped-logo3-1.png"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <div id="header " class ="header">
        <a href="/"> <IMG  src="/images/cropped-logo3-1.png" ></a>
        <h1>Knowbees Consulting Cataloging Tool <h1>

        </div>

        <img src="images/load.gif" class="loader" style="display:none" />
        <!-- Favicon Path -->

        <form method="get" id="form" action={{ route('Isbn.insertIsbn') }}>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="search_box" id="search_box">

                <br>


                <select  name="select_type1"  id="select_t1" >
                    <option value="Isbn" selected >ISBN</option>
                    <option value="Title">TITLE</option>



                    <script>
                        document.getElementById('select_t1').value = "Isbn";
                    </script>
                </select>



                <input type="text" required="required"  class="input_search" name="search" placeholder="Search ..." value=""/>
                <button type="submit" onclick="function openCity(evt, cityName)" class="btn-style" id="Go"><i class="fa fa-search"></i></button>
             

                <br>
                <br>
                <br>

            </div>

        </form>
        
        <div class="loader" style="visibility:hidden;"></div>
        
           @if(!empty($message))
                      <!-- <sapn style ="background: white;color:orange;padding:10px;font-weight: bold;font-size:16px">{{ $message }}</sapn> -->
                    <div class="alert alert-success">
      {{ $message }}  
    </div>
                    @endif


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
