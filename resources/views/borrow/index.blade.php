<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BORROWBUDDY</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Additional CSS -->
    @yield('styles')

    <!-- =======================================================
    * Template Name: Squadfree
    * Template URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
    * Updated: Mar 17 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center justify-content-between position-relative">
            <div class="logo">
                <h1 class="text-light"><a href="{{ url('/') }}"><span>BORROWBUDDY</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="{{ url('/home') }}">Home</a></li>
                    <li class="dropdown"><a href="{{ url('/borrow') }}"><span>Borrow</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ url('/member') }}">Borrow Book</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="{{ url('/book') }}"><span>Book</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('book.create') }}">Add New Book</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="{{ url('/member') }}"><span>Member</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('member.create') }}">Add New Member</a></li>
                        </ul>
                    </li>
                    @can('isAdmin')
                    <li class="dropdown"><a href="{{ url('/volunteer') }}"><span>Volunteer</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('volunteer.create') }}">Add New Volunteer</a></li>
                        </ul>
                    </li>
                    
                    @endcan

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                                </ul>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="bgg">
        <div class="bg-container" data-aos="fade-up">
        </div>
        
        <div class="container">
            <main class="py-4">
            @if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Search Form -->
<section id="portfolio" class="portfolio">

    <form method="GET" action="{{ route('borrow.index') }}" class="my-3">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Search by Book ID or IC" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="search">Search</button>
            </div>
        </div>
    </form>


    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Book ID</th>
                <th>Book Borrowed</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($borrows as $borrow)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ optional($borrow->member)->name ?? 'The member has been deleted' }}</td>
                <td>{{ $borrow->book_id }}</td>
                <td>{{ optional($borrow->book)->title ?? 'The book has been deleted' }}</td>
                <td>{{ $borrow->borrowdate }}</td>
                <td>{{ $borrow->returndate }}</td>
                <td>

                <div class="row" data-aos="fade-in">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <a  href="{{ route('borrow.edit', $borrow->id) }}" class="filter-web">Return Book</a>
              <form method="post" action="{{ route('borrow.destroy', $borrow->id) }}" onsubmit="return confirm('Are you sure you want to delete this record??')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="filter-web">Delete</button>
                        </form>
            </ul>
          </div>
        </div>

                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>

            </main>
        </div>
        </section>
        </section><!-- End Hero -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Additional Scripts -->
    @yield('scripts')
    
</body>

