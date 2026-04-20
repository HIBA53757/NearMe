<x-admin-layout>
    <div class="min-h-screen bg-[#fdfaf7] p-8 font-sans antialiased text-[#561c24]">
        <div class="max-w-4xl mx-auto space-y-12">
        
            <div class="bg-white border border-[#561c24]/10 rounded-[3rem] p-10 shadow-2xl">
                <div class="mb-10 text-center">
                    <span class="text-[10px] uppercase tracking-[0.5em] text-[#c7b7a3] font-black mb-2 block">Curation Tool</span>
                    <h2 class="text-4xl font-serif italic tracking-tighter text-[#561c24]">New Discovery Point</h2>
                </div>
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-700 p-6 rounded-[2rem] mb-8 text-[10px] font-black uppercase tracking-widest">
                        @foreach ($errors->all() as $error) <p>× {{ $error }}</p> @endforeach
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 p-6 rounded-[2rem] mb-8 text-[10px] font-black uppercase tracking-widest text-center">
                        ✓ Registry Updated Successfully
                    </div>
                @endif

                <form action="{{ route('admin.places.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="name" placeholder="Name of Location" required
                            class="w-full bg-[#fdfaf7] border-none rounded-2xl p-5 text-sm focus:ring-2 focus:ring-[#561c24]/20 transition-all placeholder:text-[#c7b7a3] font-bold">
                        
                        <div class="flex gap-3">
                            <input type="text" name="latitude" placeholder="Lat" required
                                class="flex-1 bg-[#fdfaf7] border-none rounded-2xl p-5 text-sm focus:ring-2 focus:ring-[#561c24]/20 placeholder:text-[#c7b7a3] font-mono">
                            <input type="text" name="longitude" placeholder="Long" required
                                class="flex-1 bg-[#fdfaf7] border-none rounded-2xl p-5 text-sm focus:ring-2 focus:ring-[#561c24]/20 placeholder:text-[#c7b7a3] font-mono">
                        </div>
                    </div>
                    
                    <textarea name="description" placeholder="Brief context for this discovery..."
                        class="w-full bg-[#fdfaf7] border-none rounded-[2rem] p-6 text-sm focus:ring-2 focus:ring-[#561c24]/20 transition-all placeholder:text-[#c7b7a3] h-32 leading-relaxed"></textarea>

                    <button type="submit" class="w-full bg-[#561c24] text-white py-6 rounded-[2rem] text-[11px] font-black uppercase tracking-[0.4em] hover:bg-[#6d2932] transition-all shadow-xl shadow-[#561c24]/20">
                        Register Discovery
                    </button>
                </form>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-4 px-6 mb-4">
                    <h3 class="text-[10px] uppercase tracking-[0.4em] font-black text-[#c7b7a3]">Active Registry</h3>
                    <div class="h-px flex-1 bg-[#561c24]/10"></div>
                </div>

                @foreach($places as $place)
                    <div class="bg-white border border-[#561c24]/5 p-6 rounded-[2rem] flex justify-between items-center group transition-all hover:border-[#561c24]/20">
                        <div>
                            <p class="font-serif italic text-xl text-[#561c24]">{{ $place->name }}</p>
                            <p class="text-[10px] text-[#c7b7a3] font-mono uppercase tracking-tighter">{{ $place->latitude }}, {{ $place->longitude }}</p>
                        </div>
                        <div class="bg-[#fdfaf7] px-4 py-2 rounded-full border border-[#561c24]/5">
                            <span class="text-[10px] font-black text-[#561c24] uppercase tracking-widest">{{ $place->experiences_count }} Stories</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin-layout>