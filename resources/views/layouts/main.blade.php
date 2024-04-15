<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-blue sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <!-- Logo and name at the top of the sidebar -->
                        <div class="sidebar-logo">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6TYJIJDHxuJMM0m2-DYwD_0LKUT6gdWb_A&usqp=CAU" alt="Dashboard Logo">
                            <h4>Admin</h4>
                        </div>
                        <!-- Books Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBooks" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Books
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownBooks">
                                <li><a class="dropdown-item" href="#">Add New Book</a></li>
                                <li><a class="dropdown-item" href="#">Book Lists</a></li>
                            </ul>
                        </li>

                        <!-- Genre Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownGenre" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Genre
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownGenre">
                                <li><a class="dropdown-item" href="#">Add New Genre</a></li>
                                <li><a class="dropdown-item" href="#">Genre Lists</a></li>
                            </ul>
                        </li>

                        <!-- Rental Requests Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentalRequests" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Rental Requests
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentalRequests">
                                <li><a class="dropdown-item" href="#">Pending</a></li>
                                <li><a class="dropdown-item" href="#">Approved</a></li>
                                <li><a class="dropdown-item" href="#">Rejected</a></li>
                            </ul>
                        </li>

                        <!-- Rentals List Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentalsList" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Rentals List
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentalsList">
                                <li><a class="dropdown-item" href="#">Ongoing Rentals</a></li>
                                <li><a class="dropdown-item" href="#">Completed Rentals</a></li>
                                <li><a class="dropdown-item" href="#">Due Rentals</a></li>
                                <li><a class="dropdown-item" href="#">View All Rentals</a></li>
                            </ul>
                        </li>

                        <!-- Renters Requests Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentersRequests" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Renters Requests
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentersRequests">
                                <li><a class="dropdown-item" href="#">Pending</a></li>
                                <li><a class="dropdown-item" href="#">Approved</a></li>
                                <li><a class="dropdown-item" href="#">Rejected</a></li>
                            </ul>
                        </li>

                        <!-- Renters List Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentersList" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Renters List
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentersList">
                                <li><a class="dropdown-item" href="#">Ongoing Rentals</a></li>
                                <li><a class="dropdown-item" href="#">Completed Rentals</a></li>
                                <li><a class="dropdown-item" href="#">Due Rentals</a></li>
                                <li><a class="dropdown-item" href="#">View All Renters</a></li>
                            </ul>
                        </li>

                        <!-- Librarian Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLibrarian" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Librarian
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownLibrarian">
                                <li><a class="dropdown-item" href="#">Add New Librarian</a></li>
                                <li><a class="dropdown-item" href="#">View All Librarian</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <!-- Right-aligned items (Notifications and User Profile) -->
                    <div class="btn-toolbar mb-2 mb-md-0">
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
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">My Rentals</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>                

                @yield('content')

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
