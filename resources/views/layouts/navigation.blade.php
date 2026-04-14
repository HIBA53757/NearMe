<nav class="bg-white/80 border-b border-[#e8d8c4] backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-[#561c24] tracking-tighter">
                        NearMe<span class="text-[#c7b7a3]">.</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="text-[#c7b7a3] hover:text-[#6d2932] border-transparent hover:border-[#6d2932] transition transition-colors duration-300">
                        {{ __('Explore') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-8">
                
                <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')"
                    class="text-sm font-bold {{ request()->routeIs('profile') ? 'text-[#561c24]' : 'text-[#c7b7a3]' }} hover:text-[#6d2932] transition duration-300">
                    {{ __('My Profile') }}
                </x-nav-link>

                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center focus:outline-none group">
                                <div class="w-9 h-9 rounded-full bg-[#e8d8c4] flex items-center justify-center border border-[#c7b7a3] overflow-hidden transition-all duration-300 group-hover:border-[#561c24] group-hover:shadow-md">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-5 h-5 text-[#561c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Account Management') }}
                            </div>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Settings & Privacy') }}
                            </x-dropdown-link>

                            <hr class="border-[#e8d8c4] my-1">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-red-600 font-semibold">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>