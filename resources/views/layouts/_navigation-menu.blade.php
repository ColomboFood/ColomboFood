<nav x-data="{ open: false }" class="fixed z-50 w-full h-16 bg-white border-b border-white">
    <!-- Primary Navigation Menu -->
    <div class="px-6 mx-auto xl:container">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') }}">
                        <x-jet-application-mark class="block w-auto h-6" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="container hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('product.index') }}" :active="request()->routeIs('product.index')">
                        {{ __('Shop') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="space-x-2">
                        <x-jet-nav-link class="relative" href="{{ route('cart.index') }}" :active="request()->routeIs('cart.index')">
                            <x-icons.cart/>
                            <x-cart-counter class="absolute top-0 right-0 w-4 h-4 ml-1 text-xs text-center bg-yellow-300 rounded-full"/>
                        </x-jet-nav-link>
                        <x-jet-nav-link class="relative" href="{{ route('wishlist.index') }}" :active="request()->routeIs('wishlist.index')">
                            <x-icons.heart red="false" filled="false"/>
                            <x-wishlist-counter class="absolute top-0 right-0 w-4 h-4 ml-1 text-xs text-center bg-yellow-300 rounded-full"/>
                        </x-jet-nav-link>
                    </div>

                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    @auth
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-secondary-400">
                                    <img class="object-cover rounded-full w-9 h-9" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                            
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('order.index') }}">
                                {{ __('My Orders') }}
                            </x-dropdown-link>

                            @if(Auth::user()->canAccessFilament())
                                <x-dropdown-link href="{{ route('filament.pages.dashboard') }}">
                                    {{ __('Admin Panel') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-secondary-50"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                    @else
                    <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-jet-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="absolute inset-x-0 z-50 hidden overflow-y-scroll bg-white sm:hidden"
        style="max-height: calc(100vh - 4rem);"
    >
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3">
            <div class="flex items-center px-4">
                @auth
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="mr-3 shrink-0">
                            <img class="object-cover rounded-full w-9 h-9" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                @else
                    <div class="flex flex-col text-base font-medium text-gray-800">
                        <x-dropdown-link href="{{ route('login') }}">
                                {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('register') }}">
                                {{ __('Register') }}
                        </x-dropdown-link>
                    </div>
                @endauth
            </div>

            @auth
            <div class="px-4 pt-2 pb-1 space-y-1 border-t border-secondary-50">
                @if(Auth::user()->canAccessFilament())
                <x-dropdown-link href="{{ route('filament.pages.dashboard') }}">
                    {{ __('Admin Panel') }}
                </x-dropdown-link>
                @endif

                <!-- Account Management -->
                <x-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <x-dropdown-link href="{{ route('order.index') }}">
                        {{ __('Orders') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-dropdown-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
            @endauth
        </div>

        <div class="px-4 pt-2 pb-1 space-y-1 border-t border-secondary-50">
            <x-dropdown-link href="{{ route('cart.index') }}">
                {{ __('Cart') }}
                <x-cart-counter class="inline-block w-5 h-5 text-xs text-center bg-yellow-300 rounded-full"/>
            </x-dropdown-link>
            <x-dropdown-link href="{{ route('wishlist.index') }}">
                {{ __('Wishlist') }}
                <x-wishlist-counter class="inline-block w-5 h-5 text-xs text-center bg-yellow-300 rounded-full"/>
            </x-dropdown-link>
            <x-dropdown-link href="{{ route('product.index') }}">
                {{ __('Shop') }}
            </x-dropdown-link>
        </div>
    </div>
</nav>
