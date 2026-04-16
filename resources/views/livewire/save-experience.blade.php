<div>
    <button wire:click="toggleSave" wire:loading.attr="disabled" class="group relative flex items-center justify-center transition-all duration-300 active:scale-95">

        <div class="p-3 rounded-2xl border transition-all duration-500 {{ $isSaved ? 'bg-black border-black text-white shadow-lg shadow-black/20' : 'bg-white/80 backdrop-blur-md border-black/5 text-black hover:border-black/20' }}">

            <div wire:loading wire:target="toggleSave" class="absolute inset-0 flex items-center justify-center">
                <svg class="animate-spin h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            <svg wire:loading.remove wire:target="toggleSave" 
                 class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" 
                 fill="{{ $isSaved ? 'currentColor' : 'none' }}" 
                 stroke="currentColor" 
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg>
        </div>

        <div class="absolute left-full ml-3 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap hidden lg:block">
            <span class="text-[10px] font-bold uppercase tracking-widest text-black/40">
                {{ $isSaved ? 'Saved to Collection' : 'Save Moment' }}
            </span>
        </div>
    </button>
</div>