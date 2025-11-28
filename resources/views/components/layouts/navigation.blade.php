<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">

    <!-- Top Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left Section -->
            <div class="flex items-center space-x-10">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto text-gray-800" />
                </a>

                <!-- Desktop Nav -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8">

                    <!-- Dashboard -->
                    <x-nav-link :href="route('dashboard')" 
                                :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <!-- Transactions -->
                    <x-nav-link :href="route('transactions.index')" 
                                :active="request()->routeIs('transactions.*')">
                        Transactions
                    </x-nav-link>

                    <!-- Goals -->
                    <x-nav-link :href="route('goals.index')" 
                                :active="request()->routeIs('goals.*')">
                        Goals
                    </x-nav-link>

                </div>
            </div>

            <!-- Right Section: User Menu -->
            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-600 hover:text-gray-800">
                            {{ auth()->user()->name }}

                            <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 
                                       0 011.414 1.414l-4 4a1 1 0 
                                       01-1.414 0l-4-4a1 1 0-1.414z"
                                       clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" 
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" 
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <!-- Nav Links -->
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" 
                                   :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('transactions.index')" 
                                   :active="request()->routeIs('transactions.*')">
                Transactions
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('goals.index')" 
                                   :active="request()->routeIs('goals.*')">
                Goals
            </x-responsive-nav-link>

        </div>

        <!-- User Info + Logout -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 mb-2">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>

    </div>

</nav>
