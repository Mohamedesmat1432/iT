<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (Route::has('login'))
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
                                    {{ __('Users') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('admin.departments') }}" :active="request()->routeIs('admin.departments')">
                                    {{ __('Departments') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('admin.companies') }}" :active="request()->routeIs('admin.companies')">
                                    {{ __('Comapnies') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('admin.licenses') }}" :active="request()->routeIs('admin.licenses')">
                                    {{ __('Licenses') }}
                                </x-nav-link>
                            @elseif (auth()->user()->role === 'support')
                                <x-nav-link href="{{ route('support.dashboard') }}" :active="request()->routeIs('support.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('support.companies') }}" :active="request()->routeIs('support.companies')">
                                    {{ __('Comapnies') }}
                                </x-nav-link>
                            @else
                                <x-nav-link href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            @endif
                        @else
                            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                                {{ __('Login') }}
                            </x-nav-link>

                            @if (Route::has('register'))
                                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                    {{ __('Register') }}
                                </x-nav-link>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                @auth
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                @if (auth()->user()->role === 'admin')
                                    <x-dropdown-link href="{{ route('admin.switchs') }}" :active="request()->routeIs('admin.switchs')">
                                        {{ __('Switchs') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.patchs') }}" :active="request()->routeIs('admin.patchs')">
                                        {{ __('Patchs') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.ips') }}" :active="request()->routeIs('admin.ips')">
                                        {{ __('IPs') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.edokis') }}" :active="request()->routeIs('admin.edokis')">
                                        {{ __('Edoki') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('admin.emad-edeens') }}" :active="request()->routeIs('admin.emad-edeens')">
                                        {{ __('EmadEdeen') }}
                                    </x-dropdown-link>
                                @elseif (auth()->user()->role === 'support')
                                    <x-dropdown-link href="{{ route('support.companies') }}" :active="request()->routeIs('support.companies')">
                                        {{ __('Comapnies') }}
                                    </x-dropdown-link>
                                @endif

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Route::has('login'))
                @auth
                    @if (auth()->user()->role === 'admin')
                        <x-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
                            {{ __('Users') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.departments') }}" :active="request()->routeIs('admin.departments')">
                            {{ __('Departments') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.companies') }}" :active="request()->routeIs('admin.companies')">
                            {{ __('Comapnies') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.licenses') }}" :active="request()->routeIs('admin.licenses')">
                            {{ __('Licenses') }}
                        </x-responsive-nav-link>
                    @elseif (auth()->user()->role === 'support')
                        <x-responsive-nav-link href="{{ route('support.dashboard') }}" :active="request()->routeIs('support.dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('support.companies') }}" :active="request()->routeIs('support.companies')">
                            {{ __('Comapnies') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    @endif
                @else
                    <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>

                    @if (Route::has('register'))
                        <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    @if (auth()->user()->role === 'admin')
                        <x-responsive-nav-link href="{{ route('admin.switchs') }}" :active="request()->routeIs('admin.switchs')">
                            {{ __('Switchs') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.patchs') }}" :active="request()->routeIs('admin.patchs')">
                            {{ __('Patchs') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.ips') }}" :active="request()->routeIs('admin.ips')">
                            {{ __('IPs') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.edokis') }}" :active="request()->routeIs('admin.edokis')">
                            {{ __('Edoki') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('admin.emad-edeens') }}" :active="request()->routeIs('admin.emad-edeens')">
                            {{ __('EmadEdeen') }}
                        </x-responsive-nav-link>
                    @endif
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>
