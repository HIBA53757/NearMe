<x-app-layout>
    {{-- Main Container - Nude Background (#fdfaf7) --}}
    <div class="h-screen bg-[#fdfaf7] text-[#561c24] overflow-hidden font-sans antialiased selection:bg-[#561c24] selection:text-white">
        <div class="h-full grid grid-cols-1 lg:grid-cols-12 p-4 gap-4">

            {{-- Left Side: Image Gallery --}}
            <div class="lg:col-span-7 relative group rounded-[2.5rem] overflow-hidden border border-[#561c24]/5 shadow-2xl bg-white">
                <img src="{{ $experience->photos->first() ? asset('storage/'.$experience->photos->first()->path) : 'https://picsum.photos/seed/'.$experience->id.'/1400/1000' }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 ease-out">

                {{-- Header Overlays: Location --}}
                <div class="absolute top-8 left-8">
                    <div class="bg-white/90 backdrop-blur-md px-5 py-3 rounded-2xl border border-[#561c24]/10 flex flex-col shadow-xl">
                        <span class="text-[8px] uppercase tracking-[0.4em] text-[#c7b7a3] font-bold mb-1">Location</span>
                        <div class="flex items-center gap-2">
                            <svg class="w-3 h-3 text-[#561c24]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            <h3 class="text-lg font-bold tracking-tight text-[#561c24]">{{ $experience->place->name }}</h3>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-[#561c24]/60 via-transparent to-transparent pointer-events-none"></div>

                {{-- Bottom Overlays --}}
                <div class="absolute bottom-8 left-8 right-8 flex justify-between items-end">
                    @php
                        $backUrl = request('from') === 'profile' ? route('profile') : route('dashboard');
                    @endphp

                    <a href="{{ $backUrl }}" class="group flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-white/90 hover:text-white transition-colors">
                        <span class="w-8 h-[2px] bg-white/40 group-hover:w-12 group-hover:bg-white transition-all"></span>
                        Back to Feed
                    </a>

                    {{-- Actions Pill (Repositioned to Bottom Right) --}}
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-2xl p-2.5 rounded-full border border-white/20 shadow-2xl">
                        <div class="flex items-center -gap-1">
                            <livewire:like-experience :experience="$experience" />
                            <livewire:save-experience :experience="$experience" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Info & Comments --}}
            <div class="lg:col-span-5 flex flex-col h-full gap-4 overflow-hidden">
                
                {{-- Title Card --}}
                <div class="bg-white border border-[#561c24]/5 rounded-[2.5rem] p-8 shadow-sm relative overflow-hidden">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-[10px] font-black tracking-widest uppercase text-[#c7b7a3]">
                            {{ $experience->created_at->format('M d, Y') }}
                        </span>
                        
                        {{-- Star Rating System --}}
                        <div class="flex gap-0.5">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-4 h-4 {{ $i < $experience->rating ? 'text-[#561c24]' : 'text-[#e8d8c4]' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <h1 class="text-4xl font-serif italic tracking-tighter leading-tight mb-3 text-[#561c24]">
                        {{ $experience->title }}
                    </h1>
                    <div class="flex items-center gap-2">
                        <div class="h-px w-4 bg-[#c7b7a3]"></div>
                        <p class="text-[#c7b7a3] text-[10px] font-bold uppercase tracking-widest">{{ $experience->address }}</p>
                    </div>
                </div>

                {{-- Stats Grid --}}
                <div class="grid grid-cols-4 gap-2">
                    @php
                    $stats = [
                        ['label' => 'Time', 'val' => $experience->time_of_day, 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Vibe', 'val' => $experience->ambiance, 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                        ['label' => 'Type', 'val' => str_replace('_', ' ', $experience->activity_type), 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['label' => 'Crowd', 'val' => $experience->crowd_level, 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2']
                    ];
                    @endphp

                    @foreach($stats as $stat)
                    <div class="bg-white border border-[#561c24]/5 rounded-2xl p-3 shadow-sm flex flex-col items-center justify-center text-center">
                        <svg class="w-4 h-4 mb-1.5 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke="#561c24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                        </svg>
                        <span class="text-[7px] uppercase tracking-tighter font-black text-[#c7b7a3] mb-0.5">{{ $stat['label'] }}</span>
                        <p class="text-[9px] font-bold uppercase text-[#561c24] leading-tight">{{ $stat['val'] ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>

                {{-- Scrollable Content Area --}}
                <div class="flex-1 bg-white border border-[#561c24]/5 rounded-[2.5rem] shadow-sm flex flex-col overflow-hidden">
                    <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
                        
                        {{-- Main Story --}}
                        <div class="relative mb-12">
                            <p class="text-lg leading-relaxed text-[#561c24]/90 font-light first-letter:text-5xl first-letter:font-serif first-letter:mr-3 first-letter:float-left">
                                {{ $experience->content }}
                            </p>

                            @if($experience->photos->count() > 1)
                            <div class="flex gap-4 mt-10">
                                @foreach($experience->photos->skip(1)->take(3) as $photo)
                                <div class="w-20 h-20 rounded-2xl overflow-hidden grayscale hover:grayscale-0 transition-all duration-500 cursor-zoom-in border border-[#561c24]/10">
                                    <img src="{{ asset('storage/'.$photo->path) }}" class="w-full h-full object-cover">
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        {{-- Comments Section --}}
                        <div class="border-t border-[#561c24]/5 pt-8">
                            <div class="flex items-center gap-4 mb-8">
                                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-[#561c24]">Journal Entries</h4>
                                <div class="h-[1px] flex-1 bg-gradient-to-r from-[#561c24]/10 to-transparent"></div>
                            </div>
                            
                            <livewire:experience-comments :experience="$experience" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #561c24; border-radius: 10px; }
    </style>
</x-app-layout>