<x-app-layout>
    <div class="min-h-screen bg-[#e8d8c4] py-8 px-4 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-4xl font-light text-[#561c24] tracking-tight">Explore</h2>
                    <p class="text-[#c7b7a3] font-medium uppercase tracking-widest text-xs mt-1">Discover what's happening near you</p>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search posts..." class="w-full md:w-80 border-none bg-white rounded-2xl shadow-sm focus:ring-2 focus:ring-[#6d2932] text-[#561c24] placeholder-[#c7b7a3]">
                </div>
            </div>

            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
                @foreach(range(1, 6) as $post) {{-- Simulation de posts --}}
                <div class="break-inside-avoid bg-white rounded-[2rem] shadow-lg overflow-hidden border border-white hover:shadow-2xl transition duration-300 group">
                    <div class="relative overflow-hidden">
                        <img src="https://picsum.photos/seed/{{$post}}/600/400" alt="Post image" class="w-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-[#561c24] uppercase">
                            Trending
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-full bg-[#c7b7a3] border-2 border-[#e8d8c4] overflow-hidden">
                                <img src="https://i.pravatar.cc/150?u={{$post}}" alt="avatar">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-bold text-[#561c24]">User_{{$post}}</p>
                                <p class="text-[10px] text-[#c7b7a3] uppercase">2 hours ago</p>
                            </div>
                        </div>
                        
                        <p class="text-[#6d2932] text-sm leading-relaxed mb-4">
                            Just discovered this amazing spot! The architecture and the vibe are exactly what I needed today. #Discovery #Vibes
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-[#f9f5f0]">
                            <button class="flex items-center text-[#c7b7a3] hover:text-[#561c24] transition">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                <span class="text-xs font-bold">1.2k</span>
                            </button>
                            <button class="px-4 py-2 bg-[#e8d8c4]/50 text-[#561c24] text-xs font-bold rounded-xl hover:bg-[#561c24] hover:text-white transition">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>