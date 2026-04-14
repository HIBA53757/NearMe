<x-app-layout>
    <div class="min-h-screen bg-[#fdfaf7] py-12 px-4 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 mb-8 text-xs font-black text-[#561c24] uppercase tracking-widest hover:translate-x-[-4px] transition-transform">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="3"></path></svg>
                Back to Gallery
            </a>

            <div class="bg-white rounded-[4rem] shadow-[0_32px_64px_-15px_rgba(86,28,36,0.1)] overflow-hidden border border-white/50">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="relative h-[500px] lg:h-auto">
                        <img src="{{ $experience->photos->first() ? asset('storage/'.$experience->photos->first()->path) : 'https://picsum.photos/seed/'.$experience->id.'/800/1000' }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-8 left-8">
                            <span class="bg-white text-[#561c24] px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest shadow-xl">
                                {{ $experience->place->name }}
                            </span>
                        </div>
                    </div>

                    <div class="p-10 lg:p-16 flex flex-col justify-center space-y-8">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-black text-[#c7b7a3] uppercase tracking-widest">
                                    {{ $experience->created_at->format('d F Y') }}
                                </span>
                                <div class="flex text-[#561c24] text-sm">
                                    @for($i=0; $i<$experience->rating; $i++) ★ @endfor
                                </div>
                            </div>
                            <h1 class="text-5xl font-black text-[#561c24] leading-tight">{{ $experience->title }}</h1>
                        </div>

                        {{-- Metadata Grid (Bento Style) --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-[#f9f5f0] p-4 rounded-3xl flex flex-col justify-center">
                                <span class="text-[9px] font-black text-[#c7b7a3] uppercase tracking-widest mb-1">Moment</span>
                                <p class="text-[#561c24] font-bold capitalize">{{ $experience->time_of_day ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-[#f9f5f0] p-4 rounded-3xl flex flex-col justify-center">
                                <span class="text-[9px] font-black text-[#c7b7a3] uppercase tracking-widest mb-1">Ambiance</span>
                                <p class="text-[#561c24] font-bold capitalize">{{ $experience->ambiance ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-[#f9f5f0] p-4 rounded-3xl flex flex-col justify-center">
                                <span class="text-[9px] font-black text-[#c7b7a3] uppercase tracking-widest mb-1">Activité</span>
                                <p class="text-[#561c24] font-bold capitalize">{{ str_replace('_', ' ', $experience->activity_type) ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-[#f9f5f0] p-4 rounded-3xl flex flex-col justify-center">
                                <span class="text-[9px] font-black text-[#c7b7a3] uppercase tracking-widest mb-1">Affluence</span>
                                <p class="text-[#561c24] font-bold capitalize">{{ $experience->crowd_level ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <h4 class="text-[10px] font-black text-[#c7b7a3] uppercase tracking-widest flex items-center gap-2">
                                <span class="w-4 h-px bg-[#c7b7a3]"></span> Location
                            </h4>
                            <p class="text-lg font-bold text-[#561c24] italic">{{ $experience->address ?? 'Address not specified' }}</p>
                        </div>

                        <div class="prose prose-stone">
                            <p class="text-xl text-[#6d2932]/80 font-light leading-relaxed whitespace-pre-line">
                                {{ $experience->content }}
                            </p>
                        </div>
                    </div>
                </div>

                @if($experience->photos->count() > 1)
                <div class="p-10 bg-[#f9f5f0]/50 border-t border-[#f9f5f0]">
                    <h3 class="text-xs font-black text-[#561c24] uppercase tracking-[0.3em] mb-8 text-center">Perspective Gallery</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($experience->photos->skip(1) as $photo)
                        <div class="aspect-square rounded-[2rem] overflow-hidden shadow-md">
                            <img src="{{ asset('storage/'.$photo->path) }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>