<x-app-layout>
    <div x-data="{ openCreate: false, editBio: false }" class="min-h-screen bg-[#e8d8c4] py-12 px-4 lg:px-8">
        <div class="max-w-5xl mx-auto space-y-10">

            <div class="bg-white rounded-[3rem] shadow-2xl p-8 lg:p-12 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-32 bg-[#561c24]/5"></div>

                <div class="relative inline-block mt-4">
                    <div class="w-40 h-40 bg-[#561c24] rounded-full mx-auto flex items-center justify-center text-5xl text-white font-light border-[10px] border-white shadow-2xl">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                </div>

                <h2 class="mt-6 text-4xl font-black text-[#561c24] tracking-tight">{{ $user->name }}</h2>
                <p class="text-[#c7b7a3] font-medium tracking-widest uppercase text-xs mb-6">{{ $user->email }}</p>

                <div class="max-w-2xl mx-auto mb-8">
                    <div x-show="!editBio" class="space-y-4">
                        <p class="text-[#6d2932] text-lg leading-relaxed italic">
                            {{ $user->bio ?? 'No bio shared yet. Tell the world about your adventures!' }}
                        </p>
                        <button @click="editBio = true" class="text-xs font-bold text-[#c7b7a3] hover:text-[#561c24] uppercase border-b border-transparent hover:border-[#561c24] transition-all">
                            Edit Bio
                        </button>
                    </div>

                    <form x-show="editBio" action="{{ route('profile.update-bio') }}" method="POST" class="space-y-4">
                        @csrf @method('PATCH')
                        <textarea name="bio" class="w-full rounded-2xl border-2 border-[#e8d8c4] focus:ring-[#561c24] focus:border-[#561c24] p-4 text-[#561c24]" rows="3">{{ $user->bio }}</textarea>
                        <div class="flex justify-center gap-3">
                            <button type="button" @click="editBio = false" class="px-4 py-2 text-sm font-bold text-[#c7b7a3]">Cancel</button>
                            <button type="submit" class="px-6 py-2 bg-[#561c24] text-white rounded-xl text-sm font-bold shadow-lg">Save Bio</button>
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
                <button @click="openCreate = true" class="bg-[#561c24] text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-[#561c24]/20 hover:-translate-y-1 transition-all">
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
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="font-bold text-xl text-[#561c24] leading-tight">{{ $exp->title }}</h5>
                                <div class="flex text-amber-400 text-xs">
                                    @for($i=0; $i<$exp->rating; $i++) ★ @endfor
                                </div>
                            </div>
                            <p class="text-[#c7b7a3] text-sm line-clamp-3 mb-6">{{ $exp->content }}</p>
                            <div class="flex justify-between items-center pt-4 border-t border-[#f9f5f0]">
                                <span class="text-[10px] font-bold text-[#c7b7a3] uppercase tracking-widest">{{ $exp->created_at->format('M d, Y') }}</span>
                                <button class="p-2 hover:bg-[#f9f5f0] rounded-lg transition text-[#561c24]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-white/40 rounded-[3rem] border-4 border-dashed border-white text-center">
                        <p class="text-[#c7b7a3] font-medium text-lg italic">Your adventures start here.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div x-show="openCreate" ...> 
             </div>
    </div>
</x-app-layout>