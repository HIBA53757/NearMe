<x-admin-layout>
    <div class="min-h-screen bg-[#fafafa] p-8 font-sans antialiased text-black/80">
        <div class="max-w-7xl mx-auto space-y-8">
            
            {{-- Header --}}
            <header class="flex justify-between items-end">
                <div>
                    <span class="text-[10px] uppercase tracking-[0.4em] text-black/40 font-bold">Platform Overview</span>
                    <h1 class="text-4xl font-light tracking-tighter text-black">Control Center</h1>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-mono text-black/40 uppercase">{{ now()->format('D, M d — H:i') }}</p>
                </div>
            </header>

            {{-- Stat Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @foreach([
                    ['label' => 'Total Explorers', 'value' => $stats['total_users'], 'sub' => 'active accounts'],
                    ['label' => 'Discovery Points', 'value' => $stats['total_places'], 'sub' => 'mapped locations'],
                    ['label' => 'Shared Stories', 'value' => $stats['total_experiences'], 'sub' => 'user contributions'],
                    ['label' => 'Restricted', 'value' => $stats['banned_users'], 'sub' => 'suspended access']
                ] as $stat)
                    <div class="bg-white border border-black/5 rounded-3xl p-6 shadow-sm">
                        <span class="text-[9px] uppercase tracking-widest font-bold text-black/30 block mb-1">{{ $stat['label'] }}</span>
                        <div class="text-3xl font-light text-black">{{ $stat['value'] }}</div>
                        <span class="text-[10px] text-black/20 italic">{{ $stat['sub'] }}</span>
                    </div>
                @endforeach
            </div>

            {{-- Main Management Area --}}
            <div class="bg-white border border-black/5 rounded-[2rem] overflow-hidden shadow-sm">
                <div class="p-8 border-b border-black/5 flex justify-between items-center">
                    <h2 class="text-xl font-light tracking-tight">Recent Community Activity</h2>
                    <a href="{{ route('admin.places.index') }}" class="text-[10px] uppercase tracking-widest font-bold border border-black/10 px-4 py-2 rounded-full hover:bg-black hover:text-white transition-all">
                        Manage Places
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[10px] uppercase tracking-widest text-black/30 bg-black/[0.01]">
                                <th class="px-8 py-4 font-bold">User</th>
                                <th class="px-8 py-4 font-bold">Role</th>
                                <th class="px-8 py-4 font-bold">Joined</th>
                                <th class="px-8 py-4 font-bold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5">
                            @foreach($recentUsers as $user)
                                <tr class="{{ $user->banned_at ? 'bg-red-50/30 opacity-60' : '' }} transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-black/5 flex items-center justify-center text-[10px] font-bold">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-black">{{ $user->name }}</p>
                                                <p class="text-xs text-black/40">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-xs uppercase tracking-tighter font-semibold {{ $user->role === 'admin' ? 'text-emerald-600' : 'text-black/40' }}">
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-8 py-5 text-xs text-black/40 font-mono">
                                        {{ $user->created_at->format('Y.m.d') }}
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-[10px] uppercase tracking-widest font-bold {{ $user->banned_at ? 'text-emerald-500 hover:text-emerald-700' : 'text-red-400 hover:text-red-600' }}">
                                                    {{ $user->banned_at ? 'Restore' : 'Suspend' }}
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