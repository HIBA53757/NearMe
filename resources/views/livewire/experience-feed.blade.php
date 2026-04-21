<div>
    <div class="min-h-screen bg-[#f7f0e8] py-12 px-4 lg:px-8">
        <div class="max-w-[1600px] mx-auto">


            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 border-b border-[#561c24]/10 pb-8">
                <div>
                    <h2 class="text-5xl font-serif italic text-[#561c24] tracking-tight">Explore</h2>
                    <p class="text-[#c7b7a3] font-bold uppercase tracking-[0.2em] text-[10px] mt-3">Curated experiences near your location</p>
                </div>

                <div class="relative group">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-[#c7b7a3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        placeholder="Search stories..."
                        class="w-full md:w-96 pl-12 pr-6 py-4 border-none bg-white rounded-full shadow-sm focus:ring-2 focus:ring-[#6d2932] text-[#561c24] placeholder-[#c7b7a3] transition-all">
                </div>
            </div>

            <div class="mb-10 flex flex-wrap gap-4 items-center">
                <select wire:model.live="rating" class="rounded-full border-none bg-white px-6 py-3 text-xs font-bold text-[#561c24] shadow-sm focus:ring-2 focus:ring-[#6d2932]">
                    <option value="">All Ratings</option>
                    <option value="5">Excellent</option>
                    <option value="4">Great</option>
                    <option value="3">Good </option>
                    <option value="2">Fair </option>
                </select>

                <select wire:model.live="time_of_day" class="rounded-full border-none bg-white px-6 py-3 text-xs font-bold text-[#561c24] shadow-sm focus:ring-2 focus:ring-[#6d2932]">
                    <option value="">Time of Day</option>
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                    <option value="night">Night</option>
                </select>

                <select wire:model.live="ambiance" class="rounded-full border-none bg-white px-6 py-3 text-xs font-bold text-[#561c24] shadow-sm focus:ring-2 focus:ring-[#6d2932]">
                    <option value="">Any Ambiance</option>
                    <option value="calm">Calm</option>
                    <option value="lively">Lively</option>
                    <option value="romantic">Festive</option>
                    <option value="work-friendly">Work Friendly</option>
                </select>

                <select wire:model.live="activity_type" class="rounded-full border-none bg-white px-6 py-3 text-xs font-bold text-[#561c24] shadow-sm focus:ring-2 focus:ring-[#6d2932]">
                    <option value="">Activity Type</option>
                    <option value="food">Food & Drink</option>
                    <option value="nature">Nature</option>
                    <option value="culture">Culture</option>
                    <option value="sport">Sport</option>
                    <option value="work">Work</option>
                    <option value="study">Study</option>
                    <option value="relax">Relax</option>
                    <option value="social">Social</option>
                </select>

                <select wire:model.live="crowd_level" class="rounded-full border-none bg-white px-6 py-3 text-xs font-bold text-[#561c24] shadow-sm focus:ring-2 focus:ring-[#6d2932]">
                    <option value="">Crowd Level</option>
                    <option value="quiet">Quiet</option>
                    <option value="moderate">Moderate</option>
                    <option value="crowded">Crowded</option>
                </select>

                <button wire:click="$set('search', ''); $set('rating', ''); $set('time_of_day', ''); $set('ambiance', ''); $set('activity_type', ''); $set('crowd_level', '');"
                    class="text-[10px] font-black text-[#c7b7a3] hover:text-[#561c24] uppercase tracking-widest transition-colors ml-auto">
                    Clear All
                </button>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($experiences as $post)
                <div class="flex flex-col bg-white rounded-3xl shadow-[0_10px_30px_-15px_rgba(86,28,36,0.1)] overflow-hidden hover:shadow-[0_20px_40px_-15px_rgba(86,28,36,0.2)] transition-all duration-500 group">

                    <div class="relative aspect-[4/5] overflow-hidden">
                        <img src="{{ $post->photos->first() ? asset('storage/' . $post->photos->first()->path) : 'https://picsum.photos/seed/'.$post->id.'/600/800' }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">

                        <div class="absolute top-4 left-4 bg-black/20 backdrop-blur-md border border-white/30 px-4 py-1.5 rounded-full text-[10px] font-bold text-white uppercase tracking-wider">
                            {{ $post->place->name ?? 'Local Spot' }}
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center mb-5">
                            <div class="relative">
                                <div class="w-10 h-10 rounded-full bg-[#e8d8c4] overflow-hidden ring-2 ring-[#f7f0e8]">
                                    @if($post->user->profile_photo)
                                    <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="avatar" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-[#561c24] text-white text-[10px] font-bold">
                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-xs font-black text-[#561c24] leading-none">{{ $post->user->name }}</p>
                                <p class="text-[9px] text-[#c7b7a3] font-bold uppercase mt-1 tracking-tighter">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <h4 class="font-serif text-xl text-[#561c24] mb-2 leading-tight group-hover:text-[#6d2932] transition-colors">{{ $post->title }}</h4>
                        <p class="text-[#8e7f70] text-sm leading-relaxed mb-6 line-clamp-2">
                            {{ $post->content }}
                        </p>

                        <div class="mt-auto flex items-center justify-between pt-5 border-t border-[#f9f5f0]">
                            <div class="flex text-[#c7b7a3] text-[10px] gap-0.5">
                                @for($i=0; $i < 5; $i++)
                                    <span class="{{ $i < $post->rating ? 'text-[#6d2932]' : 'text-gray-200' }}">★</span>
                                    @endfor
                            </div>

                            <a href="{{ route('experiences.show', ['experience' => $post->id, 'from' => 'explore']) }}"
                                class="text-[11px] font-bold text-[#561c24] flex items-center gap-2 group/link">
                                EXPLORE
                                <span class="w-6 h-[1px] bg-[#561c24] group-hover/link:w-10 transition-all duration-300"></span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-2xl font-serif italic text-[#561c24]">No experiences found matching "{{ $search }}"</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>