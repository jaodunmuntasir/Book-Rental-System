<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Rental System (BRS)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

    @php
        $user = auth()->user();
        $isAdmin = $user && ($user->role === 'admin');
        $isLibrarian = $user && ($user->role === 'librarian');
        $isReader = $user && ($user->role === 'reader');
    @endphp

</head>
<body>

    @include('flashmsg')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-blue sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <!-- Logo and name at the top of the sidebar -->
                        
                        <div class="sidebar-logo">
                        <a href="/">    
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6TYJIJDHxuJMM0m2-DYwD_0LKUT6gdWb_A&usqp=CAU" alt="Dashboard Logo">
                        </a>
                        @auth
                            <h4 class="company-name">{{ Auth::user()->name }}</h4>
                            <h6 class="company-name" style="text-transform:uppercase;">{{ Auth::user()->role }}</h4>
                        </div>
                        @endauth
                        <!-- Books Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBooks" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Books
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownBooks">
                                @auth
                                @if($isAdmin || $isLibrarian)
                                <li><a class="dropdown-item" href="/books/create">Add New Book</a></li>
                                @endif
                                @endauth
                                <li><a class="dropdown-item" href="/books">Book Lists</a></li>
                            </ul>
                        </li>

                        <!-- Genre Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownGenre" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Genre
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownGenre">
                                @auth
                                @if($isAdmin || $isLibrarian)
                                <li><a class="dropdown-item" href="/genres/create">Add New Genre</a></li>
                                @endif
                                @endauth
                                <li><a class="dropdown-item" href="/genres">Genre Lists</a></li>
                            </ul>
                        </li>

                        <!-- Rental Requests Menu -->
                        @auth
                        @if($isAdmin || $isLibrarian)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentalRequests" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Rental Requests
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentalRequests">
                                <li><a class="dropdown-item" href="/rentals/pendinglist">Pending</a></li>
                                <li><a class="dropdown-item" href="/rentals/approvedlist">Approved</a></li>
                                <li><a class="dropdown-item" href="/rentals/rejectedlist">Rejected</a></li>
                            </ul>
                        </li>

                        <!-- Rentals List Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentalsList" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Rentals List
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentalsList">
                                <li><a class="dropdown-item" href="/rentals/ongoinglist">Ongoing Rentals</a></li>
                                <li><a class="dropdown-item" href="/rentals/returnedlist">Completed Rentals</a></li>
                                <li><a class="dropdown-item" href="/rentals/overduelist">Overdue Rentals</a></li>
                                <li><a class="dropdown-item" href="/rentals/all">View All Rentals</a></li>
                            </ul>
                        </li>

                        <!-- Readers List Menu -->
                        <li class="nav-item">
                            <a class="nav-link" href="/readers" id="navbarReadersList" role="button" aria-expanded="false">
                                Readers List
                            </a>
                        </li>
                        @endif
                        @endauth

                        <!-- Librarian Menu -->
                        @auth
                        @if($isAdmin)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLibrarian" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Librarian
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownLibrarian">
                                <li><a class="dropdown-item" href="#">Add New Librarian</a></li>
                                <li><a class="dropdown-item" href="/librarians">View All Librarians</a></li>
                            </ul>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"></h1>
                    <!-- Right-aligned items (Notifications and User Profile) -->
                    <div class="btn-toolbar mb-2 mb-md-0">
                        
                        @auth
                        <!-- Notifications Button -->
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell"></i> <!-- Bell icon -->
                                <img src="https://cdn-icons-png.freepik.com/512/8184/8184279.png" alt="notification-icon" class="rounded-circle" style="width: 30px; height: 30px;">
                                <span class="badge bg-danger rounded-circle" style="position: absolute; top: 0px; right: 0px; width: 10px; height: 10px;"></span> <!-- Notification indicator -->
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Notification 1</a></li>
                                <li><a class="dropdown-item" href="#">Notification 2</a></li>
                                <li><a class="dropdown-item" href="#">Notification 3</a></li>
                            </ul>
                        </div>
                        <!-- User Profile Dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6TYJIJDHxuJMM0m2-DYwD_0LKUT6gdWb_A&usqp=CAU" alt="User" class="rounded-circle" style="width: 30px; height: 30px;"> <!-- User Thumbnail -->
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item">{{ Auth::user()->name }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                                @auth
                                @if($isReader)
                                <li><a class="dropdown-item" href="/myrentals">My Rentals</a></li>
                                @endif
                                @endauth
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endauth

                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif

                    </div>
                </div>                

                @yield('content')

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
