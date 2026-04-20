<x-admin-layout>
    <div class="min-h-screen bg-[#fafafa] p-8 font-sans text-black/80">
        <div class="max-w-4xl mx-auto space-y-8">
       
            <div class="bg-white border border-black/5 rounded-[2rem] p-8 shadow-sm">
                <h2 class="text-2xl font-light tracking-tighter mb-6">New Discovery Point</h2>
                
@if ($errors->any())
    <div class="bg-red-50 text-red-500 p-4 rounded-2xl mb-6 text-sm">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="bg-green-50 text-green-600 p-4 rounded-2xl mb-6 text-sm">
        {{ session('success') }}
    </div>
@endif

                <form action="{{ route('admin.places.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="name" placeholder="Location Name" required
                            class="bg-[#fafafa] border-none rounded-2xl p-4 text-sm focus:ring-1 focus:ring-black/10 transition-all placeholder:text-black/20">
                        
                        <div class="flex gap-2">
                            <input type="text" name="latitude" placeholder="Lat" required
                                class="flex-1 bg-[#fafafa] border-none rounded-2xl p-4 text-sm focus:ring-1 focus:ring-black/10 transition-all placeholder:text-black/20">
                            <input type="text" name="longitude" placeholder="Long" required
                                class="flex-1 bg-[#fafafa] border-none rounded-2xl p-4 text-sm focus:ring-1 focus:ring-black/10 transition-all placeholder:text-black/20">
                        </div>
                    </div>
                    
                    <textarea name="description" placeholder="Brief context for this place..."
                        class="w-full bg-[#fafafa] border-none rounded-2xl p-4 text-sm focus:ring-1 focus:ring-black/10 transition-all placeholder:text-black/20 h-24"></textarea>

                    <button type="submit" class="w-full bg-black text-white py-4 rounded-2xl text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-black/80 transition-all shadow-lg shadow-black/10">
                        Register Location
                    </button>
                </form>
            </div>


            <div class="space-y-3">
                <h3 class="text-[10px] uppercase tracking-widest font-bold text-black/30 px-4">Active Registry</h3>
                @foreach($places as $place)
                    <div class="bg-white border border-black/5 p-5 rounded-2xl flex justify-between items-center group hover:border-black/20 transition-all">
                        <div>
                            <p class="font-medium">{{ $place->name }}</p>
                            <p class="text-[10px] text-black/40 font-mono">{{ $place->latitude }}, {{ $place->longitude }}</p>
                        </div>
                        <div class="text-[10px] uppercase font-bold text-black/20 group-hover:text-black/60 transition-colors">
                            {{ $place->experiences_count }} Experiences
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin-layout>