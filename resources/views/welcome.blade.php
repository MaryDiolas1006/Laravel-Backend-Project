<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bambin Gesu'</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                /*background-color: #fff;*/
                background: url('https://www.arcgis.com/sharing/rest/content/items/6c036c09c490450db100cbf867c7688a/resources/1571940616424.png?w=3340');
                /*color: #900d0d;*/
                font-family: 'Russo One', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50px;
                font-weight: 400;
                color: #e8f044;
                border-bottom: 5px solid #00bcd4;
            }

            .links > a {
                color: #81b214;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 80px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    CSCJ Bambin Gesu'
                </div>

                <div class="links">
                    
                </div>
            </div>
        </div>
    </body>
</html>
