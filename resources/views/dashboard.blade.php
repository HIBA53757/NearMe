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
                @foreach($experiences as $post)
                <div class="break-inside-avoid bg-white rounded-[2rem] shadow-lg overflow-hidden border border-white hover:shadow-2xl transition duration-300 group">
                    
                    <div class="relative overflow-hidden">
                        <img src="{{ $post->photos->first() ? asset('storage/' . $post->photos->first()->path) : 'https://picsum.photos/seed/'.$post->id.'/600/400' }}" 
                             alt="Post image" 
                             class="w-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-[#561c24] uppercase">
                            {{ $post->place->name ?? 'Local Spot' }}
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- User Info --}}
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-full bg-[#c7b7a3] border-2 border-[#e8d8c4] overflow-hidden">
                                @if($post->user->profile_photo)
                                    <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="avatar">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-[#561c24] text-white text-xs">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-bold text-[#561c24]">{{ $post->user->name }}</p>
                                <p class="text-[10px] text-[#c7b7a3] uppercase">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <h4 class="font-bold text-[#561c24] mb-1">{{ $post->title }}</h4>
                        <p class="text-[#6d2932] text-sm leading-relaxed mb-4 line-clamp-3">
                            {{ $post->content }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-[#f9f5f0]">
                            <div class="flex text-[#561c24] text-[10px]">
                                @for($i=0; $i < $post->rating; $i++) ★ @endfor
                            </div>
                         
                            <a href="{{ route('experiences.show', $post->id) }}" class="px-4 py-2 bg-[#e8d8c4]/50 text-[#561c24] text-xs font-black rounded-xl hover:bg-[#561c24] hover:text-white transition uppercase tracking-tighter">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>