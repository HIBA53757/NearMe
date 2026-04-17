<x-app-layout>
    <div class="h-screen bg-[#fafafa] text-black/80 overflow-hidden font-sans antialiased selection:bg-black selection:text-white">
        <div class="h-full grid grid-cols-1 lg:grid-cols-12 p-4 gap-4">

            <div class="lg:col-span-7 relative group rounded-3xl overflow-hidden border border-black/5">
                <img src="{{ $experience->photos->first() ? asset('storage/'.$experience->photos->first()->path) : 'https://picsum.photos/seed/'.$experience->id.'/1400/1000' }}"
                    class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000 ease-out">

                <div class="absolute top-8 left-8 right-8 flex justify-between items-start">
                    <div class="backdrop-blur-xl bg-white/60 px-6 py-4 rounded-2xl border border-white/20 flex flex-col shadow-sm">
                        <span class="text-[10px] uppercase tracking-[0.4em] text-black/40 font-bold mb-1">Authenticated Location</span>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                            <h3 class="text-xl font-medium tracking-tight text-black">{{ $experience->place->name }}</h3>
                        </div>
                    </div>

                    <div class="flex items-center gap-1.5 backdrop-blur-xl bg-white/60 p-1.5 rounded-2xl border border-white/20 shadow-sm">
                        <div class="pl-1">
                            <livewire:like-experience :experience="$experience" />
                        </div>
                        <div class="w-px h-8 bg-black/5 mx-1"></div>
                        <livewire:save-experience :experience="$experience" />
                    </div>
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>

                <div class="absolute bottom-8 left-8 right-8 flex justify-between items-end">
                    @php
                    $backUrl = request('from') === 'profile' ? route('profile') : route('dashboard');
                    @endphp

                    <a href="{{ $backUrl }}" class="group flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-white/90 hover:text-white transition-colors">
                        <span class="w-8 h-px bg-white/40 group-hover:w-12 transition-all"></span>
                        Exit Gallery
                    </a>

                    <div class="text-[10px] font-mono text-white/60 uppercase">
                        Ref. {{ $experience->id }} // {{ $experience->created_at->format('Y') }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col h-full gap-4 overflow-hidden">

                <div class="bg-white border border-black/5 rounded-3xl p-8 flex flex-col justify-between shadow-sm">
                    <div class="flex justify-between items-start mb-6">
                        <span class="px-3 py-1 rounded-full border border-black/10 text-[10px] font-bold tracking-widest uppercase text-black/60">
                            {{ $experience->created_at->format('M d, Y') }}
                        </span>
                        <div class="flex gap-1.5">
                            @for($i=0; $i<5; $i++)
                                <div class="w-1.5 h-1.5 rounded-full {{ $i < $experience->rating ? 'bg-black' : 'bg-black/10' }}">
                                </div>
                            @endfor
                        </div>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-light tracking-tighter leading-none mb-2 text-black">
                        {{ $experience->title }}
                    </h1>
                    <p class="text-black/40 text-sm font-light italic truncate">{{ $experience->address }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @php
                    $stats = [
                        ['label' => 'Moment', 'val' => $experience->time_of_day, 'icon' => 'M20 12h-4l-3 9L9 3l-3 9H2'],
                        ['label' => 'Vibe', 'val' => $experience->ambiance, 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3'],
                        ['label' => 'Activity', 'val' => str_replace('_', ' ', $experience->activity_type), 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['label' => 'Crowd', 'val' => $experience->crowd_level, 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2']
                    ];
                    @endphp

                    @foreach($stats as $stat)
                    <div class="bg-white border border-black/5 rounded-2xl p-5 hover:bg-gray-50 transition-colors shadow-sm">
                        <div class="flex items-center gap-3 mb-2 opacity-30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke="black">
                                <path d="{{ $stat['icon'] }}" />
                            </svg>
                            <span class="text-[9px] uppercase tracking-[0.2em] font-bold text-black">{{ $stat['label'] }}</span>
                        </div>
                        <p class="text-sm font-semibold tracking-wide uppercase text-black/80">{{ $stat['val'] ?? 'None' }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="flex-1 bg-white border border-black/5 rounded-3xl p-8 relative overflow-hidden shadow-sm flex flex-col">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-black">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21L14.017 18C14.017 16.8954 14.9125 16 16.0171 16H19.0171V14.5C19.0171 13.1193 17.8978 12 16.5171 12H15.0171V10H16.5171C19.0024 10 21.0171 12.0147 21.0171 14.5V21H14.017Z" />
                        </svg>
                    </div>
                    <div class="prose prose-slate max-w-none overflow-y-auto mb-6 flex-shrink-0">
                        <p class="text-lg leading-relaxed text-black/60 font-light">
                            {{ $experience->content }}
                        </p>
                    </div>

                    @if($experience->photos->count() > 1)
                    <div class="flex gap-3 mb-8">
                        @foreach($experience->photos->skip(1)->take(3) as $photo)
                        <div class="w-12 h-12 rounded-lg overflow-hidden border border-black/10">
                            <img src="{{ asset('storage/'.$photo->path) }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                    @endif

    
                    <div class="mt-auto border-t border-black/5 pt-8">
                        <div class="flex items-center gap-2 mb-6 opacity-40">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em]">Community Feed</span>
                            <div class="h-px flex-1 bg-black/10"></div>
                        </div>
                        
                        <livewire:experience-comments :experience="$experience" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>