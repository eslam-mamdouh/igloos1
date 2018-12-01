<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <script type="text/javascript" src = "<?php echo asset('js/jquery-3.1.1.js'); ?>"></script>
      <link href = "{{asset('css/homePage.css')}}" rel="stylesheet">
      link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <!--<link href = "{{asset('bootstrap/bootstrap.css')}}" rel="stylesheet">-->
        <link href = "{{asset('css/bootstrap.css')}}" rel="stylesheet">
        <link href = "{{asset('css/homePage.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css\profile_settings.css">
        <link rel="stylesheet" type="text/css" href="css\working_space.css">
    </head>
    <body>
        <div id="topNavbar">
            <div id="Logo"></div>
                 <div class="navbar-btns">
                    <img src="/images/IGLOOS-logo-white.png" alt="IGLOOS" class="logo">
                    @if (!Auth::user())
                    <a class="btn" id="signupbtn" href="/signup">Sign Up</a>
                    <a class="btn" id="defbtn" href="{{url('/login')}}">Login</a>
                    @endif
                    @if(Auth::user()->role == "admin")
                            <a style="background:orange;padding::7px" class="btn" id="defbtn" href="/admin/spaces">Admin Panel</a>
                    @endif
                    @if(Auth::user()->role == "space")
                        <a style="background:orange;padding::7px" class="btn" id="defbtn" href="/space-admin">Space Admin</a>
                    @endif
                    <a class="btn" id="defbtn" href="#clients-section">Clients</a>
                    <a class="btn" id="defbtn" href="#about-section">About</a>
            </div>
        </div>



        @yield('content')



        <footer class="page-footer"> 
                <p class="footer-txt1">Lovingly crafted in Cairo, EG.</p>
                <!--img src="IGLOOS-logo-black.png" alt="IGLOOS" class="bottom-logo"-->
        </footer>
    </body>
</html>