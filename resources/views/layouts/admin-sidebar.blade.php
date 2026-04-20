<aside class="w-72 h-screen bg-[#fdfaf7] border-r border-[#561c24]/10 flex flex-col font-sans antialiased">

    <div class="p-10 mb-6">
        <span class="text-[9px] uppercase tracking-[0.5em] text-[#c7b7a3] font-black block mb-1">Authenticated</span>
        <div class="text-2xl font-serif italic tracking-tighter text-[#561c24]">
     Admin <span class="font-sans not-italic font-light opacity-40"></span>
        </div>
    </div>

    <nav class="flex-1 px-6 space-y-2">
        <a href="{{ route('admin.dashboard') }}" 
           class="group flex items-center justify-between px-6 py-4 rounded-2xl transition-all duration-500 {{ request()->routeIs('admin.dashboard') ? 'bg-[#561c24] text-white shadow-xl shadow-[#561c24]/20' : 'text-[#561c24]/60 hover:bg-[#561c24]/5 hover:text-[#561c24]' }}">
            <span class="text-[11px] uppercase tracking-[0.3em] font-black">Dashboard</span>
            <div class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.dashboard') ? 'bg-white' : 'bg-[#561c24]/20 group-hover:bg-[#561c24]' }}"></div>
        </a>

        <a href="{{ route('admin.places.index') }}" 
           class="group flex items-center justify-between px-6 py-4 rounded-2xl transition-all duration-500 {{ request()->routeIs('admin.places.index') ? 'bg-[#561c24] text-white shadow-xl shadow-[#561c24]/20' : 'text-[#561c24]/60 hover:bg-[#561c24]/5 hover:text-[#561c24]' }}">
            <span class="text-[11px] uppercase tracking-[0.3em] font-black">Places</span>
            <div class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.places.index') ? 'bg-white' : 'bg-[#561c24]/20 group-hover:bg-[#561c24]' }}"></div>
        </a>
    </nav>

    <div class="p-8 border-t border-[#561c24]/5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full group flex items-center gap-3 px-6 py-4 rounded-2xl bg-white border border-[#561c24]/5 text-red-400 hover:text-red-600 hover:border-red-100 hover:shadow-lg transition-all duration-500">
                <svg class="w-4 h-4 opacity-50 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-[10px] uppercase tracking-[0.3em] font-black">Sign Out</span>
            </button>
        </form>
    
    </div>
</aside>