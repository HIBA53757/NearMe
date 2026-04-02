<x-guest-layout>
    <div class="min-h-screen bg-[#e8d8c4] p-4 lg:p-8 font-sans">
        
        <nav class="max-w-7xl mx-auto flex justify-between items-center mb-12 bg-white/50 backdrop-blur-md p-6 rounded-3xl shadow-sm">
            <div class="text-2xl font-bold text-[#561c24] tracking-tighter">
                NearMe<span class="text-[#c7b7a3]">.</span>
            </div>
            
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-[#561c24] font-semibold hover:underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 text-[#6d2932] font-bold hover:text-[#561c24] transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2 bg-[#561c24] text-[#e8d8c4] rounded-xl font-bold shadow-lg shadow-[#561c24]/20 hover:bg-[#6d2932] transition">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <main class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-white rounded-[2.5rem] overflow-hidden shadow-xl group">
                <div class="relative h-96 lg:h-full min-h-[400px]">
                    <img src="" 
                         class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Featured">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#561c24]/90 via-transparent to-transparent p-10 flex flex-col justify-end">
                        <span class="bg-[#c7b7a3] text-[#561c24] text-xs font-bold px-3 py-1 rounded-full w-fit mb-4 uppercase tracking-widest">
                            Most Liked
                        </span>
                        <h1 class="text-4xl lg:text-5xl font-light text-white mb-4 leading-tight">
                            Discover the most <br> popular spots around you.
                        </h1>
                        <div class="flex items-center text-[#e8d8c4] space-x-4">
                            <span class="flex items-center"><i class="far fa-heart mr-2"></i> 2.4k Likes</span>
                            <span class="flex items-center"><i class="far fa-comment mr-2"></i> 128 Comments</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-8">
                <div class="bg-[#6d2932] p-8 rounded-[2.5rem] shadow-xl text-[#e8d8c4] flex flex-col justify-center">
                    <h3 class="text-2xl font-bold mb-4">Share your experience</h3>
                    <p class="opacity-80 mb-6 text-sm leading-relaxed">
                        Join our community to post reviews and save your favorite locations.
                    </p>
                    <a href="{{ route('register') }}" class="w-full py-4 bg-[#e8d8c4] text-[#561c24] text-center font-bold rounded-2xl hover:bg-white transition shadow-lg">
                        Get Started
                    </a>
                </div>

                <div class="bg-white p-6 rounded-[2.5rem] shadow-lg border border-[#e8d8c4]">
                    <h4 class="text-[#561c24] font-bold mb-4 px-2">Trending Now</h4>
                    <div class="space-y-4">
                        @foreach([1, 2, 3] as $item)
                        <div class="flex items-center space-x-4 p-2 hover:bg-[#e8d8c4]/20 rounded-2xl transition cursor-pointer">
                            <div class="w-12 h-12 rounded-xl bg-[#c7b7a3] flex-shrink-0 overflow-hidden">
                                <img src="">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#561c24]">Modern Interior Design</p>
                                <p class="text-xs text-[#c7b7a3]">by Ahmed B.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-guest-layout>