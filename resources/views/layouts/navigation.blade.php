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

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="flex items-center space-x-6">

                  <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
    {{ __('My Profile') }}
</x-nav-link>
                    
                    <a href="{{ url('profile') }}" 
                       class="flex items-center space-x-2 text-sm font-bold {{ request()->is('profile') ? 'text-[#561c24]' : 'text-[#c7b7a3]' }} hover:text-[#6d2932] transition duration-300">
                        <div class="w-8 h-8 rounded-full bg-[#e8d8c4] flex items-center justify-center border border-[#c7b7a3]">
                            <svg class="w-4 h-4 text-[#561c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span>Profile</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-5 py-2 bg-[#561c24] text-[#e8d8c4] rounded-xl text-xs font-bold shadow-lg shadow-[#561c24]/20 hover:bg-[#6d2932] transition transform hover:scale-105 active:scale-95">
                            LOG OUT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>