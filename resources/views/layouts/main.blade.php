<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Book Rental System</title>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Library Book Rental System
            </h1>
        </div>
    </header>

    <!-- left sidebar -->
    <div class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
        <!-- Book -->
        <ul class="space-y-2">
            <li>
                <button class="font-bold w-full text-left" onclick="toggleDropdown('book-menu')">Book</button>
                <ul id="book-menu" class="hidden pl-4 space-y-1">
                    <li><a href="#" class="hover:text-gray-300">Add New Book</a></li>
                    <li><a href="#" class="hover:text-gray-300">Book Lists</a></li>
                </ul>
            </li>

            <!-- Genre -->
            <li>
                <button class="font-bold w-full text-left" onclick="toggleDropdown('genre-menu')">Genre</button>
                <ul id="genre-menu" class="hidden pl-4 space-y-1">
                    <li><a href="#" class="hover:text-gray-300">Add New Genre</a></li>
                    <li><a href="#" class="hover:text-gray-300">Genre Lists</a></li>
                </ul>
            </li>

            <!-- Rentals -->
            <li>
                <button class="font-bold w-full text-left" onclick="toggleDropdown('rentals-menu')">Rentals</button>
                <ul id="rentals-menu" class="hidden pl-4 space-y-1">
                    <!-- Sub-menu example -->
                    <li>
                        <button class="w-full text-left" onclick="toggleDropdown('rental-requests-menu')">Rental Requests</button>
                        <ul id="rental-requests-menu" class="hidden pl-4 space-y-1">
                            <li><a href="#" class="hover:text-gray-300">Pending</a></li>
                            <li><a href="#" class="hover:text-gray-300">Approved</a></li>
                            <li><a href="#" class="hover:text-gray-300">Rejected</a></li>
                        </ul>
                        <button class="w-full text-left" onclick="toggleDropdown('rentals-list-menu')">Rentals List</button>
                        <ul id="rentals-list-menu" class="hidden pl-4 space-y-1">
                            <li><a href="#" class="hover:text-gray-300">Ongoing Rentals</a></li>
                            <li><a href="#" class="hover:text-gray-300">Completed Rentals</a></li>
                            <li><a href="#" class="hover:text-gray-300">Due Rentals</a></li>
                            <li><a href="#" class="hover:text-gray-300">View All Rentals</a></li>
                        </ul>
                        <button class="w-full text-left" onclick="toggleDropdown('renter-requests-menu')">Renter Requests</button>
                        <ul id="renter-requests-menu" class="hidden pl-4 space-y-1">
                            <li><a href="#" class="hover:text-gray-300">Pending</a></li>
                            <li><a href="#" class="hover:text-gray-300">Approved</a></li>
                            <li><a href="#" class="hover:text-gray-300">Rejected</a></li>
                        </ul>
                        <button class="w-full text-left" onclick="toggleDropdown('renters-list-menu')">Renters List</button>
                        <ul id="renters-list-menu" class="hidden pl-4 space-y-1">
                            <li><a href="#" class="hover:text-gray-300">Ongoing Rentals</a></li>
                            <li><a href="#" class="hover:text-gray-300">Completed Rentals</a></li>
                            <li><a href="#" class="hover:text-gray-300">Due Rentals</a></li>
                            <li><a href="#" class="hover:text-gray-300">View All Renters</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>



    <!-- Main Content -->
    <!-- <main> -->
        @yield('content')
    <!-- </main> -->

    <!-- Footer -->
    <footer class="bg-white shadow mt-12">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-500">
                &copy; 2024 Book Rental System. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- <script src="resources\js\script.js"></script> -->
    <!-- <script src="{{ asset('js/script.js') }}"></script> -->

    <script>
        function toggleDropdown(menuId) {
            var element = document.getElementById(menuId);
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
