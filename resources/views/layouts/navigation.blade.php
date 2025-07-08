
<nav x-data="{ open: false }" class="border-b border-grey-100 bg-blue">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center gap-2 px-2 py-2 shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto text-gray-100 h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden gap-2 px-3 py-3 sm:flex sm:space-x-20 sm:ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="gap-2 px-4 py-2 text-md">
                        Dashboard
                    </x-nav-link>

                    @can('view permissions')
                        <x-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')" class="gap-2 px-4 py-2 text-md">
                            Permissions
                        </x-nav-link>
                    @endcan

                    @can('view roles')
                        <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')" class="gap-2 px-4 py-2 text-md">
                            Roles
                        </x-nav-link>
                    @endcan

                    @can('view users')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" class="gap-2 px-4 py-2 text-md">
                            Users
                        </x-nav-link>
                    @endcan

                    @can('view articles')
                        <x-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')" class="gap-2 px-4 py-2 text-md">
                            Articles
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 transition hover:text-gray-700 focus:outline-none">
                            {{-- <div>{{ Auth::user()->name }} ({{ Auth::user()->roles('name')->implode->(', ') }})</div> --}}
                            <div>
    {{ Auth::user()->name }} ({{ Auth::user()->roles->pluck('name')->implode(', ') }})
</div>

                            <div class="ml-1">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414L10 13.414l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <!-- Logout -->
                        {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form> --}}


<!-- Link-style logout using a form -->
{{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
<a href="#" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
   class="text-red-600 hover:underline">
   Logout
</a>

    @csrf
</form> --}}
{{-- class="text-red-600 hover:underline --}}
<!-- Logout link outside the form -->
<a href="#"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit(); " class="px-4 py-4 text-red-600 hover:underline">
   Logout
</a>

<!-- Hidden logout form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

                        
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile Menu) -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-gray-500 hover:bg-gray-100">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @can('view permissions')
                <x-responsive-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')">
                    Permissions
                </x-responsive-nav-link>
            @endcan

            @can('view roles')
                <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                    Roles
                </x-responsive-nav-link>
            @endcan

            @can('view users')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    Users
                </x-responsive-nav-link>
            @endcan

            @can('view articles')
                <x-responsive-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')">
                    Articles
                </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Dropdown -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }} </div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }} </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="get" action="{{ route('logout') }}">
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
