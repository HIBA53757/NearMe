<x-admin-layout>
 
    <div class="min-h-screen bg-[#fdfaf7] p-8 font-sans antialiased text-[#561c24] selection:bg-[#561c24] selection:text-white">
        <div class="max-w-7xl mx-auto space-y-10">
           
            <header class="flex justify-between items-end border-b border-[#561c24]/10 pb-8">
                <div>
                    <span class="text-[10px] uppercase tracking-[0.5em] text-[#c7b7a3] font-black mb-2 block">System Intelligence</span>
                    <h1 class="text-5xl font-serif italic tracking-tighter text-[#561c24]">Control Center</h1>
                </div>
                <div class="text-right">
                    <p class="text-[11px] font-mono text-[#c7b7a3] uppercase tracking-tighter">{{ now()->format('D, M d — H:i') }}</p>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach([
                    ['label' => 'Total Explorers', 'value' => $stats['total_users'], 'sub' => 'active accounts', 'color' => 'text-[#561c24]'],
                    ['label' => 'Discovery Points', 'value' => $stats['total_places'], 'sub' => 'mapped locations', 'color' => 'text-[#561c24]'],
                    ['label' => 'Shared Stories', 'value' => $stats['total_experiences'], 'sub' => 'contributions', 'color' => 'text-[#561c24]'],
                    ['label' => 'Restricted', 'value' => $stats['banned_users'], 'sub' => 'suspended access', 'color' => 'text-red-700']
                ] as $stat)
                    <div class="bg-white border border-[#561c24]/5 rounded-[2rem] p-7 shadow-sm group hover:border-[#561c24]/20 transition-all duration-500">
                        <span class="text-[9px] uppercase tracking-widest font-black text-[#c7b7a3] block mb-4">{{ $stat['label'] }}</span>
                        <div class="text-4xl font-serif italic {{ $stat['color'] }} mb-1">{{ $stat['value'] }}</div>
                        <span class="text-[10px] text-[#c7b7a3] font-medium uppercase tracking-tighter">{{ $stat['sub'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="bg-white border border-[#561c24]/5 rounded-[3rem] overflow-hidden shadow-xl">
                <div class="p-10 border-b border-[#561c24]/5 flex justify-between items-center bg-[#f9f5f0]/50">
                    <h2 class="text-2xl font-serif italic tracking-tight text-[#561c24]">Community Activity</h2>
                    <a href="{{ route('admin.places.index') }}" class="text-[10px] uppercase tracking-[0.2em] font-black bg-[#561c24] text-white px-8 py-4 rounded-full hover:bg-[#6d2932] transition-all shadow-lg shadow-[#561c24]/20">
                        Manage Places
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[10px] uppercase tracking-[0.3em] text-[#c7b7a3] bg-[#fdfaf7]">
                                <th class="px-10 py-6 font-black">Explorer</th>
                                <th class="px-10 py-6 font-black text-center">Clearance</th>
                                <th class="px-10 py-6 font-black text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#561c24]/5">
                            @foreach($recentUsers as $user)
                                <tr class="{{ $user->banned_at ? 'bg-red-50/40' : '' }} group hover:bg-[#fdfaf7]/50 transition-colors">
                                    <td class="px-10 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-[#561c24] text-white flex items-center justify-center text-[10px] font-black shadow-inner">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-[#561c24]">{{ $user->name }}</p>
                                                <p class="text-[11px] text-[#c7b7a3] font-medium lowercase">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-10 py-6 text-center">
                                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $user->role === 'admin' ? 'bg-[#561c24] text-white' : 'border border-[#561c24]/10 text-[#c7b7a3]' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-6 text-right">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-[10px] uppercase tracking-[0.2em] font-black {{ $user->banned_at ? 'text-emerald-600' : 'text-red-500' }}">
                                                    {{ $user->banned_at ? '[ Restore Access ]' : '[ Terminate ]' }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>