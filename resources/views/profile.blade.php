<x-app-layout>
    <div x-data="{ open: false, editBio: false }" class="min-h-screen bg-[#e8d8c4] py-12 px-4 lg:px-8">
        <div class="max-w-5xl mx-auto space-y-12">

            <div class="bg-white rounded-[3rem] shadow-2xl p-8 lg:p-12 text-center relative overflow-hidden border border-white">
                <div class="absolute top-0 left-0 w-full h-24 bg-[#561c24]/5"></div>

                <div class="relative inline-block mt-4">
                    <div class="w-32 h-32 bg-[#561c24] rounded-full mx-auto flex items-center justify-center text-4xl text-white font-light border-[8px] border-white shadow-xl">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                </div>

                <h2 class="mt-6 text-4xl font-black text-[#561c24] tracking-tight">{{ $user->name }}</h2>
                <p class="text-[#c7b7a3] font-medium text-xs mb-6 uppercase tracking-widest">{{ $user->email }}</p>

                <div class="max-w-2xl mx-auto mb-10">
                    <div x-show="!editBio" class="space-y-3">
                        <p class="text-[#6d2932] text-lg italic leading-relaxed">
                            {{ $user->bio ?? 'Adventure is out there. Tell the world your story!' }}
                        </p>
                        <button @click="editBio = true" class="text-[10px] font-bold text-[#c7b7a3] hover:text-[#561c24] uppercase border-b border-transparent hover:border-[#561c24] transition-all">
                            Edit Bio
                        </button>
                    </div>

                    <form x-show="editBio" x-cloak action="{{ route('profile.update-bio') }}" method="POST" class="space-y-4">
                        @csrf 
                        @method('PATCH')
                        <textarea name="bio" class="w-full rounded-2xl border-2 border-[#e8d8c4] focus:ring-[#561c24] focus:border-[#561c24] p-4 text-[#561c24]" rows="3">{{ $user->bio }}</textarea>
                        <div class="flex justify-center gap-3">
                            <button type="button" @click="editBio = false" class="px-4 py-2 text-sm font-bold text-[#c7b7a3]">Cancel</button>
                            <button type="submit" class="px-6 py-2 bg-[#561c24] text-white rounded-xl text-sm font-bold shadow-lg">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto">
                    <div class="bg-[#f9f5f0] p-6 rounded-[2rem] border border-[#e8d8c4]/50">
                        <span class="block text-3xl font-black text-[#561c24]">{{ $myExperiences->count() }}</span>
                        <span class="text-[10px] uppercase font-bold text-[#c7b7a3]">Experiences</span>
                    </div>
                    <div class="bg-[#f9f5f0] p-6 rounded-[2rem] border border-[#e8d8c4]/50">
                        <span class="block text-3xl font-black text-[#561c24]">{{ $likesCount ?? 0 }}</span>
                        <span class="text-[10px] uppercase font-bold text-[#c7b7a3]">Total Likes</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center px-4">
                <h4 class="text-2xl font-light text-[#561c24] tracking-tight">Your Journey</h4>
                <button @click="open = true" class="bg-[#561c24] text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:-translate-y-1 transition-all">
                    + New Experience
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($myExperiences as $exp)
                    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl group border border-white hover:border-[#e8d8c4] transition-all">
                        <div class="h-56 overflow-hidden relative">
                            <img src="{{ $exp->photos->first() ? asset('storage/'.$exp->photos->first()->path) : 'https://picsum.photos/seed/'.$exp->id.'/600/400' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-[#561c24] uppercase shadow-sm">
                                    {{ $exp->place->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h5 class="font-bold text-xl text-[#561c24] mb-2">{{ $exp->title }}</h5>
                            <p class="text-[#c7b7a3] text-sm line-clamp-3 mb-6">{{ $exp->content }}</p>
                            <div class="flex justify-between items-center pt-4 border-t border-[#f9f5f0]">
                                <span class="text-[10px] font-bold text-[#c7b7a3] uppercase tracking-widest">{{ $exp->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-white/40 rounded-[3rem] border-4 border-dashed border-white text-center">
                        <p class="text-[#c7b7a3] font-medium text-lg italic">No adventures shared yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#561c24]/40 backdrop-blur-sm">
            
            <div @click.away="open = false" class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-2xl overflow-hidden relative">
                <button @click="open = false" class="absolute top-6 right-6 text-[#c7b7a3] hover:text-[#561c24]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="p-8 lg:p-12">
                    <header class="mb-8">
                        <h2 class="text-3xl font-light text-[#561c24]">New Experience</h2>
                        <p class="text-[#c7b7a3] text-sm mt-1">Share your latest adventure with the community.</p>
                    </header>

                    <form action="{{ route('experiences.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div class="rounded-2xl border-2 border-[#e8d8c4] p-4">
                            <label class="block text-xs font-bold text-[#6d2932] uppercase mb-1">Title</label>
                            <input type="text" name="title" required class="w-full border-none p-0 focus:ring-0 text-[#561c24]" placeholder="Where did you go?">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="rounded-2xl border-2 border-[#e8d8c4] p-4">
                                <label class="block text-xs font-bold text-[#6d2932] uppercase mb-1">Place</label>
                                <select name="place_id" required class="w-full border-none p-0 focus:ring-0 text-[#561c24] bg-transparent">
                                    @foreach($places as $place)
                                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="rounded-2xl border-2 border-[#e8d8c4] p-4">
                                <label class="block text-xs font-bold text-[#6d2932] uppercase mb-1">Rating</label>
                                <select name="rating" class="w-full border-none p-0 focus:ring-0 text-[#561c24] bg-transparent">
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="3" selected>⭐⭐⭐</option>
                                </select>
                            </div>
                        </div>

                        <div class="rounded-2xl border-2 border-transparent p-4 bg-[#e8d8c4]/30">
                            <label class="block text-xs font-bold text-[#c7b7a3] uppercase mb-1">Your Review</label>
                            <textarea name="content" rows="4" required class="w-full border-none p-0 bg-transparent focus:ring-0 text-[#561c24]" placeholder="Tell us about the vibes, flavors, and moments..."></textarea>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <div class="flex-1 border-2 border-dashed border-[#c7b7a3] rounded-xl p-3 text-center relative hover:bg-[#f9f5f0]">
                                <input type="file" name="photos[]" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                                <span class="text-xs font-bold text-[#561c24]">Add Photos +</span>
                            </div>
                            <button type="submit" class="bg-[#561c24] text-white px-10 py-4 rounded-2xl font-bold shadow-lg">Post Story</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>