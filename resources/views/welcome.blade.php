<x-guest-layout>
    <div class="min-h-screen bg-[#fdfaf7] p-4 lg:p-8 font-sans antialiased text-[#561c24]">
        
        {{-- Navigation --}}
        <nav class="max-w-7xl mx-auto flex justify-between items-center mb-12 bg-white/80 backdrop-blur-xl p-6 rounded-[2rem] border border-[#561c24]/5 shadow-sm">
            <div class="text-3xl font-serif italic tracking-tighter text-[#561c24]">
                NearMe<span class="text-[#c7b7a3]">.</span>
            </div>
            
            <div class="flex items-center space-x-2">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-[#561c24] text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-[#561c24]/20 transition-all hover:scale-105">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-[#c7b7a3] hover:text-[#561c24] transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-[#561c24] text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-[#561c24]/20 transition-all hover:scale-105">
                                Join Now
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <main class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- Featured Experience (Dynamic) --}}
            <div class="lg:col-span-8 bg-white rounded-[3rem] overflow-hidden shadow-2xl border border-[#561c24]/5 group relative min-h-[600px]">
                @if($featured)
                    <img src="{{ $featured->photos->first() ? asset('storage/'.$featured->photos->first()->path) : 'https://picsum.photos/seed/'.$featured->id.'/1200/800' }}" 
                         class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105" alt="{{ $featured->title }}">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#561c24] via-[#561c24]/40 to-transparent p-12 flex flex-col justify-end">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="bg-[#fdfaf7] text-[#561c24] text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.3em]">
                                Most Appreciated
                            </span>
                            <div class="h-px w-12 bg-white/30"></div>
                        </div>

                        <h1 class="text-5xl lg:text-7xl font-serif italic text-white mb-6 leading-tight tracking-tighter">
                            {{ $featured->title }}
                        </h1>

                        <div class="flex items-center gap-8 text-[#fdfaf7]/80 text-[10px] font-black uppercase tracking-[0.2em]">
                            <span class="flex items-center gap-2">
                                <i class="fas fa-heart text-[#c7b7a3]"></i>
                                {{ $featured->liked_by_users_count ?? 0 }} Appreciations
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fas fa-comment text-[#c7b7a3]"></i>
                                {{ $featured->comments_count ?? 0 }} Notes
                            </span>
                        </div>
                    </div>
                @else
                    <div class="h-full flex flex-col items-center justify-center bg-[#f9f5f0] p-12 text-center">
                        <div class="w-20 h-20 border border-[#561c24]/10 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-map-marked-alt text-[#c7b7a3]"></i>
                        </div>
                        <h2 class="text-2xl font-serif italic text-[#561c24]">Awaiting the first discovery.</h2>
                        <p class="text-[10px] uppercase tracking-widest text-[#c7b7a3] mt-2 font-black">Be the one to map the world.</p>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-4 flex flex-col gap-8">
                
                {{-- CTA Card --}}
                <div class="bg-[#561c24] p-10 rounded-[2.5rem] shadow-2xl text-[#fdfaf7] relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full transition-transform group-hover:scale-150 duration-700"></div>
                    <h3 class="text-3xl font-serif italic mb-4 relative z-10">Document the unseen.</h3>
                    <p class="text-[#c7b7a3] mb-8 text-xs font-medium leading-relaxed tracking-wide relative z-10">
                        Join an exclusive collective of explorers documenting the world's most hidden gems.
                    </p>
                    <a href="{{ route('register') }}" class="block w-full py-5 bg-[#fdfaf7] text-[#561c24] text-center text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl hover:bg-white transition-all shadow-xl relative z-10">
                        Create Account
                    </a>
                </div>

                {{-- Trending List (Dynamic) --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-[#561c24]/5 flex-1">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-[#561c24] text-[10px] font-black uppercase tracking-[0.3em]">Latest Registry</h4>
                        <div class="h-px w-12 bg-[#c7b7a3]/30"></div>
                    </div>

                    <div class="space-y-6">
                        @forelse($trending as $experience)
                            <a href="{{ route('experiences.show', $experience) }}" class="flex items-center space-x-4 group cursor-pointer">
                                <div class="w-16 h-16 rounded-2xl bg-[#f9f5f0] flex-shrink-0 overflow-hidden border border-[#561c24]/5">
                                    <img src="{{ $experience->photos->first() ? asset('storage/'.$experience->photos->first()->path) : 'https://picsum.photos/seed/'.$experience->id.'/200' }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-sm font-bold text-[#561c24] truncate group-hover:text-[#c7b7a3] transition-colors">
                                        {{ $experience->title }}
                                    </p>
                                    <p class="text-[9px] text-[#c7b7a3] font-black uppercase tracking-widest mt-1">
                                        By {{ $experience->user->name }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="py-12 text-center">
                                <p class="text-[10px] text-[#c7b7a3] font-black uppercase tracking-widest">No recent activity</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>

        <footer class="max-w-7xl mx-auto mt-12 flex justify-between items-center px-8 opacity-40">
            <span class="text-[9px] font-mono uppercase tracking-[0.4em]">NearMe Collective © 2026</span>
            <span class="text-[9px] font-mono uppercase tracking-[0.4em]">Designed for Explorers</span>
        </footer>
    </div>
</x-guest-layout>