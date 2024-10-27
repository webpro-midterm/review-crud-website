<nav class="bg-[#1F2833] h-16 flex items-center">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo or Brand -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20" />
        </a>

        <!-- Hamburger Menu for Mobile -->
        <div class="block md:hidden">
            <button id="menu-btn" class="text-white focus:outline-none">
                <!-- Hamburger icon (three lines) -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Links -->
        <div id="menu" class="hidden md:flex space-x-4">
            <a href="{{ route('dashboard') }}" class="hover:text-gray-400 text-white">Home</a>
            <a href="{{ route('movies.index') }}" class="hover:text-gray-400 text-white">Post</a>
            <a href="{{ route('reviews.index') }}" class="hover:text-gray-400 text-white">Reviews</a>
        </div>

        <!-- Authentication Links -->
        <div id="auth-links" class="hidden md:flex space-x-4">
            @guest
                <a href="{{ route('login') }}" class="hover:text-gray-400 text-white">Login</a>
                <a href="{{ route('register') }}" class="hover:text-gray-400 text-white">Register</a>
            @else
                <a href="{{ route('dashboard') }}" class="hover:text-gray-400 text-white">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-gray-400 text-white">Profile</a> <!-- Profile link added -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-gray-400 text-white">Logout</button>
                </form>
            @endguest
        </div>
    </div>

    <!-- Mobile Menu (Initially Hidden) -->
    <div id="mobile-menu" class="md:hidden hidden flex-col items-center bg-[#2F4156] space-y-4 p-4">
        <a href="{{ url('/') }}" class="hover:text-gray-400 text-white">Home</a>
        <a href="{{ route('movies.index') }}" class="hover:text-gray-400 text-white">Movies</a>
        <a href="{{ route('reviews.index') }}" class="hover:text-gray-400 text-white">Reviews</a>
        <a href="{{ route('categories.index') }}" class="hover:text-gray-400 text-white">Categories</a> <!-- New Category Link -->
        @guest
            <a href="{{ route('login') }}" class="hover:text-gray-400 text-white">Login</a>
            <a href="{{ route('register') }}" class="hover:text-gray-400 text-white">Register</a>
        @else
            <a href="{{ route('dashboard') }}" class="hover:text-gray-400 text-white">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="hover:text-gray-400 text-white">Profile</a> <!-- Profile link added for mobile -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:text-gray-400 text-white">Logout</button>
            </form>
        @endguest
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        // Toggle visibility of mobile menu
        mobileMenu.classList.toggle('hidden');
    });
</script>
