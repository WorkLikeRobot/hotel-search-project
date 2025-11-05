<!-- ========== HEADER ========== -->
<header class="absolute top-0 left-0 w-full z-50 py-6">
    <nav class="container flex items-center justify-between">
        <!-- Logo -->
        <a href="#" class="text-3xl font-extrabold text-slate-900 dark:text-white">
            RumahImpian
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex items-center space-x-8">
            <a href="#"
                class="font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Beranda</a>
            <a href="#"
                class="font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Properti</a>
            <a href="#"
                class="font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Agen</a>
            <a href="#"
                class="font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Tentang
                Kami</a>
        </div>

        <!-- Right side: Icons & User Menu -->
        <div class="flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode"
                class="p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-brand-dark-light focus:outline-hidden focus:ring-2 focus:ring-primary"
                aria-label="Toggle dark mode">
                <!-- Sun Icon (Light Mode) -->
                <svg x-show="!darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <!-- Moon Icon (Dark Mode) -->
                <svg x-show="darkMode" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                    </path>
                </svg>
            </button>

            @guest
                <a href="{{ route('login') }}"
                    class="hidden lg:inline-block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Log
                    In</a>
                <a href="{{ route('register') }}" class="hidden lg:inline-block btn btn-primary btn-sm">Register</a>
            @endguest

            @auth
                <!-- User Avatar Dropdown -->
                <div class="relative">
                    <button @click="userMenuOpen = !userMenuOpen"
                        class="block w-10 h-10 rounded-full overflow-hidden border-2 border-primary focus:outline-hidden focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        <img src="{{ auth()->user()->profile_image_url ?? 'https://placehold.co/40x40/F97316/FFFFFF?text=' . substr(auth()->user()->name, 0, 1) }}" alt="{{ auth()->user()->name }}"
                            class="w-full h-full object-cover">
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="userMenuOpen" @click.outside="userMenuOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-brand-dark-light rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50"
                        x-cloak>
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-brand-dark">Dashboard</a>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-brand-dark">Profile</a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}"
                                class="block w-full px-4 py-2 text-left text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-brand-dark"
                                @click.prevent="$root.submit();">
                                Sign Out
                            </a>
                        </form>
                    </div>
                </div>
            @endauth

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 rounded-md text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-brand-dark-light"
                aria-label="Toggle mobile menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu Panel -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-4"
        class="lg:hidden absolute top-full left-0 w-full bg-white dark:bg-brand-dark shadow-lg rounded-b-lg p-5 z-40"
        x-cloak>
        <div class="flex flex-col space-y-4">
            <a href="#"
                class="block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Beranda</a>
            <a href="#"
                class="block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Properti</a>
            <a href="#"
                class="block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Agen</a>
            <a href="#"
                class="block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Tentang
                Kami</a>
            <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
                @guest
                    <a href="{{ route('login') }}"
                        class="block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Log
                        In</a>
                    <a href="{{ route('register') }}"
                        class="mt-2 block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Register</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Dashboard</a>
                    <a href="{{ route('profile.edit') }}"
                        class="mt-2 block font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light">Profile</a>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}"
                            class="mt-2 block w-full text-left font-medium text-slate-700 dark:text-slate-300 hover:text-primary dark:hover:text-primary-light"
                            @click.prevent="$root.submit();">
                            Sign Out
                        </a>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>