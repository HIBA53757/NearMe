<x-app-layout>
    <div class="min-h-screen bg-[#fafafa] selection:bg-black selection:text-white px-8 py-12">
        
        {{-- Header --}}
        <header class="max-w-7xl mx-auto mb-16">
            <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-[0.5em] text-black/30 font-bold mb-2">Personal Collection</span>
                <h1 class="text-5xl font-light tracking-tighter text-black">Saved Moments</h1>
                <div class="h-px w-20 bg-black/10 mt-6"></div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto">
            @if($experiences->isEmpty())
                <div class="h-[40vh] flex flex-col items-center justify-center border border-black/5 bg-white rounded-[3rem] shadow-sm">
                    <p class="text-black/30 font-light italic text-lg tracking-tight">Your collection is currently empty.</p>
                    <a href="{{ route('dashboard') }}" class="mt-6 text-[10px] font-bold uppercase tracking-[0.3em] text-black border-b border-black pb-1 hover:text-black/50 hover:border-black/20 transition-all">
                        Discover Experiences
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($experiences as $post)
                        <div class="group relative bg-white border border-black/5 rounded-[2.5rem] overflow-hidden hover:shadow-2xl transition-all duration-700 ease-out">
                            
                            {{-- Image Container --}}
                            <div class="aspect-[4/5] relative overflow-hidden">
                                <img src="{{ $post->photos->first() ? asset('storage/'.$post->photos->first()->path) : 'https://picsum.photos/seed/'.$post->id.'/800/1000' }}" 
                                     class="w-full h-full object-cover grayscale-[30%] group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000 ease-out">
                                
                                {{-- Quick Save Toggle --}}
                                <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="backdrop-blur-md bg-white/40 p-1 rounded-2xl border border-white/20 shadow-sm">
                                        <livewire:save-experience :experience="$post" wire:key="save-{{ $post->id }}" />
                                    </div>
                                </div>

                                {{-- Details Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-8 left-8 right-8">
                                    <span class="text-[9px] uppercase tracking-widest text-white/60 font-bold mb-1 block">{{ $post->place->name }}</span>
                                    <h2 class="text-2xl font-medium tracking-tight text-white mb-4">{{ $post->title }}</h2>
                                    
                                    <a href="{{ route('experiences.show', ['experience' => $post->id, 'from' => 'saved']) }}" 
                                       class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white/90 hover:text-white transition-colors">
                                        <span class="w-6 h-px bg-white/40 group-hover:w-10 transition-all"></span>
                                        Explore Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>