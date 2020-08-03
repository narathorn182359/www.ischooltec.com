<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ischooltec</title>
        <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Fonts -->
    
        <style>
             body,h1,h2,h3,h4,h5,h6,b,span{
    font-family: 'Bai Jamjuree', sans-serif;
  }
            .imgbk {
                /* Location of the image */
                background-image: url(/img/home.jpg);
                /* Background image is centered vertically and horizontally at all times */
                background-position: center center;
                /* Background image doesn't tile */
                background-repeat: no-repeat;
                /* Background image is fixed in the viewport so that it doesn't move when
            the content's height is greater than the image's height */
                background-attachment: fixed;
                /* This is what makes the background image rescale based
            on the container's size */
                background-size: cover;
                /* Set a background color that will be displayed
            while the background image is loading */
                background-color: #464646;
            }
    
            .buttonlogin {
                background-color: #FF4F5B;
            }
        </style>
        <!-- Styles -->
        <style>
        

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
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body class="imgbk">
        <div class="flex-center position-ref full-height">
        

            <div class="content">
                <div class="title m-b-md">
                    @if (Route::has('login'))
                
                        @auth
                            <a  lass="btn btn-info btn-lg"  href="{{ url('/home') }}">หน้าแรก</a>
                        @else
                            <a  class="btn btn-info btn-lg"  href="{{ route('login') }}">เข้าระบบ</a>
                          
                        @endauth
                 
                @endif
                </div>
               

          
            </div>
        </div>
    </body>
</html>
