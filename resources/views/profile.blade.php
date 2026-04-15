<x-app-layout>
    <div x-data="{ open: false, editBio: false, images: [] }" class="min-h-screen bg-[#fdfaf7] py-12 px-4 lg:px-8">
        <div class="max-w-6xl mx-auto space-y-16">

            <div class="relative">
                <div class="absolute -top-10 -left-10 w-64 h-64 bg-[#e8d8c4] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
                <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-[#561c24] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>

                <div class="relative bg-white/70 backdrop-blur-xl rounded-[4rem] shadow-[0_32px_64px_-15px_rgba(86,28,36,0.1)] p-8 lg:p-16 border border-white/50">
                    <div class="flex flex-col md:flex-row items-center gap-12">

                        <div class="relative group cursor-pointer" onclick="document.getElementById('profilePhotoInput').click()">
                            <div class="w-44 h-44 rounded-[3rem] bg-[#561c24] p-1 rotate-3 group-hover:rotate-0 transition-all duration-500 shadow-2xl overflow-hidden">
                                <div class="w-full h-full rounded-[2.8rem] bg-[#561c24] flex items-center justify-center text-6xl text-white font-thin overflow-hidden border-4 border-white">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($user->name, 0, 1) }}
                                    @endif
                                </div>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/20 rounded-[3rem] rotate-3 group-hover:rotate-0">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex-1 text-center md:text-left space-y-6">
                            <div>
                                <h2 class="text-5xl font-black text-[#561c24] leading-tight">{{ $user->name }}</h2>
                                <p class="text-[#c7b7a3] font-bold tracking-[0.3em] uppercase text-sm mt-2">{{ $user->email }}</p>
                            </div>

                            <div class="relative">
                                <div x-show="!editBio" class="group">
                                    <p class="text-xl text-[#6d2932]/80 font-light leading-relaxed max-w-xl">
                                        "{{ $user->bio ?? 'Adventure is out there. Tell the world your story!' }}"
                                    </p>
                                    <button @click="editBio = true" class="mt-4 flex items-center gap-2 text-xs font-black text-[#561c24] opacity-0 group-hover:opacity-100 transition-all uppercase tracking-tighter">
                                        Edit Narrative <span class="h-px w-8 bg-[#561c24]"></span>
                                    </button>
                                </div>

                                <form x-show="editBio" x-cloak action="{{ route('profile.update-bio') }}" method="POST" class="max-w-xl space-y-4">
                                    @csrf
                                    @method('PATCH')
                                    <textarea name="bio" class="w-full rounded-3xl border-none bg-[#f9f5f0] focus:ring-2 focus:ring-[#561c24] p-6 text-[#561c24] text-lg italic" rows="3">{{ $user->bio }}</textarea>
                                    <div class="flex gap-4">
                                        <button type="submit" class="px-8 py-3 bg-[#561c24] text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl">Update</button>
                                        <button type="button" @click="editBio = false" class="px-8 py-3 text-[#c7b7a3] text-xs font-black uppercase tracking-widest">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="flex flex-row md:flex-col gap-4">
                            <div class="bg-white px-8 py-6 rounded-[2.5rem] shadow-sm border border-[#e8d8c4]/30 text-center">
                                <span class="block text-4xl font-black text-[#561c24]">{{ $myExperiences->count() }}</span>
                                <span class="text-[9px] uppercase font-black text-[#c7b7a3] tracking-widest">Stories</span>
                            </div>
                            <div class="bg-white px-8 py-6 rounded-[2.5rem] shadow-sm border border-[#e8d8c4]/30 text-center">
                                <span class="block text-4xl font-black text-[#561c24]">{{ $likesCount ?? 0 }}</span>
                                <span class="text-[9px] uppercase font-black text-[#c7b7a3] tracking-widest">Impact</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-end gap-6 px-4">
                <div class="space-y-2">
                    <h4 class="text-4xl font-black text-[#561c24] tracking-tighter">Personal Gallery</h4>
                    <p class="text-[#c7b7a3] font-medium italic">Your curated moments and shared places.</p>
                </div>
                <button @click="open = true" class="group relative bg-[#561c24] text-white pl-8 pr-12 py-5 rounded-full font-black text-xs uppercase tracking-widest shadow-[0_20px_40px_-10px_rgba(86,28,36,0.3)] hover:scale-105 transition-all">
                    Share New Story
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 rounded-full p-1 group-hover:rotate-90 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" stroke-width="3"></path>
                        </svg>
                    </span>
                </button>
            </div>

            <div class="columns-1 sm:columns-2 lg:columns-4 gap-6 space-y-6 px-4">
                @forelse($myExperiences as $exp)
               <a href="{{ route('experiences.show', ['experience' => $exp->id, 'from' => 'profile']) }}" class="block break-inside-avoid bg-white rounded-[2.5rem] overflow-hidden shadow-[0_10px_30px_-15px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_-15px_rgba(86,28,36,0.2)] transition-all duration-500 border border-gray-100 group">
                    <div class="relative overflow-hidden aspect-[4/5]">
                        <img src="{{ $exp->photos->first() ? asset('storage/'.$exp->photos->first()->path) : 'https://picsum.photos/seed/'.$exp->id.'/400/500' }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">

                        <div class="absolute top-4 left-4">
                            <span class="bg-[#561c24] text-white px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-wider shadow-lg">
                                {{ $exp->place->name }}
                            </span>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 p-6 flex flex-col justify-end">
                            <p class="text-white text-xs font-medium leading-relaxed">
                                {{ Str::limit($exp->content, 80) }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 bg-white">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-black text-[#561c24]/40 uppercase tracking-widest">
                                {{ $exp->created_at->format('d M Y') }}
                            </span>
                            <div class="flex text-[#561c24] text-[10px]">
                                @for($i=0; $i<$exp->rating; $i++) ★ @endfor
                            </div>
                        </div>
                        <h5 class="font-black text-lg text-[#1a1a1a] leading-tight group-hover:text-[#561c24] transition-colors">
                            {{ $exp->title }}
                        </h5>
                    </div>
                </a>
                @empty
                <div class="col-span-full py-24 bg-white/50 rounded-[3rem] border-2 border-dashed border-[#c7b7a3] text-center">
                    <p class="text-[#561c24] font-bold text-sm uppercase tracking-widest opacity-40">Aucun souvenir partagé ici.</p>
                </div>
                @endforelse
            </div>
        </div>

        <form id="profilePhotoForm" action="{{ route('profile.update-photo') }}" method="POST" enctype="multipart/form-data" class="hidden">
            @csrf
            <input type="file" id="profilePhotoInput" name="photo" onchange="document.getElementById('profilePhotoForm').submit()">
        </form>

        <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-[#561c24]/60 backdrop-blur-xl">
            <div @click.away="open = false" class="bg-white rounded-[4rem] shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto relative border border-white">
                <div class="p-10 lg:p-16 grid grid-cols-1 lg:grid-cols-2 gap-12">

                    <div>
                        <header class="mb-10">
                            <h2 class="text-4xl font-black text-[#561c24] tracking-tight">New Story</h2>
                            <p class="text-[#c7b7a3] font-bold uppercase text-[10px] tracking-widest mt-2">Document your local discovery</p>
                        </header>

                       <form action="{{ route('experiences.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <input type="text" name="title" required class="w-full bg-[#f9f5f0] border-none rounded-2xl p-5 focus:ring-2 focus:ring-[#561c24] text-[#561c24] font-bold placeholder:text-[#c7b7a3]" placeholder="Experience Title">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <select name="place_id" required class="w-full bg-[#f9f5f0] border-none rounded-2xl p-5 focus:ring-2 focus:ring-[#561c24] text-[#561c24] font-bold">
            @foreach($places as $place)
                <option value="{{ $place->id }}">{{ $place->name }}</option>
            @endforeach
        </select>

        <div class="rounded-2xl border-2 border-[#e8d8c4] p-4 bg-[#f9f5f0]/30">
            <label class="block text-[10px] font-bold text-[#6d2932] uppercase mb-1">Rating</label>
            <select name="rating" class="w-full border-none p-0 focus:ring-0 text-[#561c24] bg-transparent font-bold">
                <option value="5" selected>⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
   
        <div class="bg-[#f9f5f0] p-4 rounded-2xl">
            <label class="block text-[10px] font-black text-[#c7b7a3] uppercase mb-2">Moment</label>
            <select name="time_of_day" class="w-full bg-transparent border-none p-0 text-[#561c24] font-bold focus:ring-0">
                <option value="matin">Matin</option>
                <option value="après-midi">Après-midi</option>
                <option value="soir">Soir</option>
            </select>
        </div>

        <div class="bg-[#f9f5f0] p-4 rounded-2xl">
            <label class="block text-[10px] font-black text-[#c7b7a3] uppercase mb-2">Ambiance</label>
            <select name="ambiance" class="w-full bg-transparent border-none p-0 text-[#561c24] font-bold focus:ring-0">
                <option value="calme">Calme</option>
                <option value="animé">Animé</option>
                <option value="festif">Festif</option>
                <option value="studieux">Studieux</option>
            </select>
        </div>

        <div class="bg-[#f9f5f0] p-4 rounded-2xl">
            <label class="block text-[10px] font-black text-[#c7b7a3] uppercase mb-2">Activité</label>
            <select name="activity_type" class="w-full bg-transparent border-none p-0 text-[#561c24] font-bold focus:ring-0">
                <option value="travailler">Travailler</option>
                <option value="étudier">Étudier</option>
                <option value="se détendre">Détente</option>
                <option value="amis">Amis/Famille</option>
            </select>
        </div>

        <div class="bg-[#f9f5f0] p-4 rounded-2xl">
            <label class="block text-[10px] font-black text-[#c7b7a3] uppercase mb-2">Affluence</label>
            <select name="crowd_level" class="w-full bg-transparent border-none p-0 text-[#561c24] font-bold focus:ring-0">
                <option value="faible">Faible</option>
                <option value="moyen">Moyen</option>
                <option value="élevé">Élevé</option>
            </select>
        </div>
    </div>

    <div class="space-y-1">
        <label class="text-[10px] font-black text-[#561c24] uppercase tracking-widest ml-2">Location Address</label>
        <input type="text" name="address" class="w-full bg-[#f9f5f0] border-none rounded-2xl p-5 focus:ring-2 focus:ring-[#561c24] text-[#561c24] font-bold placeholder:text-[#c7b7a3]" placeholder="123 Street Name, City...">
    </div>

    <textarea name="content" rows="4" required class="w-full bg-[#f9f5f0] border-none rounded-3xl p-6 focus:ring-2 focus:ring-[#561c24] text-[#561c24] placeholder:text-[#c7b7a3]" placeholder="Share your story..."></textarea>

    <div class="relative group border-2 border-dashed border-[#e8d8c4] rounded-3xl p-6 text-center hover:bg-[#fdfaf7] transition-all">
        <input type="file" name="photos[]" multiple class="absolute inset-0 opacity-0 cursor-pointer">
        <p class="text-xs font-black text-[#561c24] uppercase">Add Photos</p>
    </div>

    <button type="submit" class="w-full bg-[#561c24] text-white py-5 rounded-3xl font-black uppercase tracking-[0.2em] shadow-2xl hover:scale-[1.02] transition-transform">Publish Experience</button>
</form>
                    </div>

                    <div class="hidden lg:block bg-[#f9f5f0] rounded-[3rem] p-8 space-y-6 border border-[#e8d8c4]/30">
                        <div class="h-full flex flex-col justify-center items-center text-center space-y-4">
                            <template x-if="images.length === 0">
                                <div class="space-y-4">
                                    <div class="w-20 h-20 bg-white rounded-full mx-auto flex items-center justify-center text-[#c7b7a3]">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[10px] font-black uppercase text-[#c7b7a3] tracking-[0.2em]">Visual Preview Area</p>
                                </div>
                            </template>

                            <div class="grid grid-cols-2 gap-4 w-full">
                                <template x-for="url in images">
                                    <img :src="url" class="w-full h-40 object-cover rounded-[2rem] shadow-lg animate-fade-in">
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>