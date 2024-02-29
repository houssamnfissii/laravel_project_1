
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Custom styles -->
    <style>
        body{
            background: #eee;
            margin: 0;
            padding: 0;
        }

        #side_nav{
            background: #000;
            min-width: 250px;
            max-width: 250px;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 2000; /* Adjust z-index value higher than navbar */
            overflow-y: auto;
        }
        
        .content{
            min-height: 100vh;
            width: 100%;
            margin-left: 250px; /* Adjust this value according to the sidebar width */
            overflow-y: auto;
            padding-top: 56px; /* Adjust this value according to the navbar height */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        hr.h-color{
            background: #eee;
        }

        .sidebar li.active{
            background: #eee;
            border-radius: 8px;
        }

        .sidebar li.active a, .sidebar li.active a:hover {
            color: #000;
        }
        .sidebar li a{
            color: #fff;
        }

        @media(max-width: 767px){
            #side_nav{
                margin-left: -250px;
                position: absolute;
                min-height: 100vh;
                z-index: 2000; /* Adjust z-index value higher than navbar */
            }
            #side_nav.active{
                margin-left: 0;
            }
        }
        .expert-img{
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 1px solid #888;
    }
    
  .upload-button,.file-upload{
    position: absolute;
    top: 95px;
    left: 18px;
    overflow: hidden;
    border-bottom-left-radius: 40px;
    border-bottom-right-radius: 40px;
    color: #fff;
    background:#000;
    height: 25px;
    width: 100px;
    text-indent:4px;
  
    }
    
    .file-upload {
        display: none !important;
    }

    </style>
</head>
<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4">
                    <span class="text-white">
                       IN MOROCCO
                    </span>
                </h1>
              
            </div>

            <ul class="list-unstyled px-2">
                <li class="active"><a href="{{ route('home') }}" class="text-decoration-none px-3 py-2 d-block">HOME</a></li>

                @auth
                @if(auth()->user()->role === 'admin')
                    <li class=""><a href="{{ route('trip.index') }}" class="text-decoration-none px-3 py-2 d-block">Trips</a></li>
                    <li class=""><a href="{{ route('user.index') }}" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">Users</a></li>
                    <li class=""><a href="{{ route('activity.index') }}" class="text-decoration-none px-3 py-2 d-block">Activities</a></li>
                @elseif(auth()->user()->role === 'user')
                    <li class=""><a href="{{ route('explore') }}" class="text-decoration-none px-3 py-2 d-block">Explore</a></li>
                    <li class=""><a href="{{ route('user.trips') }}" class="text-decoration-none px-3 py-2 d-block">My trips</a></li>
                @endif
            @endauth
            </ul>
            <hr class="h-color mx-2">

            <ul class="list-unstyled px-2">
                <a href="/" class="text-decoration-none px-3 py-2 d-block text-light"> French</a>
                @guest
               <a href="/" class="text-decoration-none px-3 py-2 d-block text-light"> @Copy right 2024</a>
                @else
                <li class=""><a href="{{ route('profile.edit', Auth::user()->id) }}" class="text-decoration-none px-3 py-2 d-block">Profile</a></li>
                <li><a class="text-decoration-none px-3 py-2 d-block"  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
                @endguest
             

            </ul>

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                     <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span class="bg-dark rounded px-2 py-0 text-white">=</span></a>
                       
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fal fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ms-auto">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                                </li>
                            @else    
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        >Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </li>

            
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                      </div>
                   </div>
            </nav>
            <div class="container">
                @yield('content')
                
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    

    <script>
     $(document).ready(function() {
    
            function setActiveLink() {
                var currentUrl = window.location.href;
                $('.sidebar li').removeClass('active');
                $('.sidebar li a').each(function() {
                    if ($(this).attr('href') === currentUrl) {
                        $(this).closest('li').addClass('active');
                    }
                });
            }

            // Call the function on page load
            setActiveLink();
        });
    </script>
</body>
</html>
