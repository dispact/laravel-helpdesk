<div class="flex flex-col flex-1 w-full">
    <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div class="container flex items-center justify-between h-full px-6 
            mx-auto text-blue-600 dark:text-blue-300"
        >
        
            <!-- Mobile hamburger -->
            <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none 
                focus:shadow-outline-purple"
                @click="toggleSideMenu"
                aria-label="Menu"
            >
                <x-icons.icon name='hamburger'/>
            </button>
            
            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-blue-500">
                    @if (request()->routeIs('buildings.index'))
                        <x-nav.search type="buildings"/>
                    @elseif (request()->routeIs('categories.index'))
                        <x-nav.search type="categories"/>
                    @elseif (request()->routeIs('tickets.index'))
                        <x-nav.search type="tickets"/>
                    @elseif (request()->routeIs('users.index'))
                        <x-nav.search type="users"/>
                    @elseif (request()->routeIs('requests.index'))
                        <x-nav.search type="requests"/>
                    @elseif (request()->routeIs('status.index'))
                        <x-nav.search type="status"/>
                    @endif
                </div>
            </div>

            <ul class="flex items-center flex-shrink-0 space-x-6">
                <!-- Theme toggler -->
                <li class="flex">
                    <button class="rounded-md focus:outline-none focus:shadow-outline-blue text-blue-500
                        dark:text-blue-400 dark:hover:text-blue-500 hover:text-blue-600"
                        @click="toggleTheme"
                        aria-label="Toggle color mode"
                    >
                        <template x-if="!dark">
                            <x-icons.icon name="moon"/>
                        </template>
                        <template x-if="dark">
                            <x-icons.icon name="sun"/>
                        </template>
                    </button>
                </li>
            
                <!-- Profile menu -->
                <li class="relative">
                    <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                        @click="toggleProfileMenu"
                        @keydown.escape="closeProfileMenu"
                        aria-label="Account"
                        aria-haspopup="true"
                    >
                        <img
                            class="object-cover w-8 h-8 rounded-full"
                            src="https://i.pravatar.cc/100?u={{ auth()->user()->id }}"
                            alt=""
                            aria-hidden="true"
                        />
                    </button>

                    <template x-if="isProfileMenuOpen">
                        <ul class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 
                                bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 
                                dark:text-gray-300 dark:bg-gray-700"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click.away="closeProfileMenu"
                            @keydown.escape="closeProfileMenu"
                            aria-label="submenu"
                        >

                            <x-nav.dropdown-item text="Log out" icon="logout" type="button"
                                link="{{ route('logout') }}"
                            />

                        </ul>
                    </template>
                </li>
            </ul>
        </div>
    </header>
    {{ $slot }}
</div>