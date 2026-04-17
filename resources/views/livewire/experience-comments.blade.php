<div class="space-y-8">
    <div class="relative">
        <textarea 
            wire:model.defer="newComment"
            placeholder="Share your thoughts on this experience..."
            class="w-full bg-black/[0.02] border-none rounded-3xl p-6 text-sm focus:ring-1 focus:ring-black/10 transition-all placeholder:text-black/20 resize-none min-h-[120px]"
        ></textarea>
        
        <button 
            wire:click="postComment"
            wire:loading.attr="disabled"
            class="absolute bottom-4 right-4 bg-black text-white px-6 py-2 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-black/80 transition-all disabled:opacity-50"
        >
            <span wire:loading.remove>Post</span>
            <span wire:loading>...</span>
        </button>
    </div>

    <div class="space-y-6 max-h-[400px] overflow-y-auto pr-4 custom-scrollbar">
        @forelse($comments as $comment)
            <div class="flex gap-4 group">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-black/5 flex items-center justify-center overflow-hidden">
                    @if($comment->user->profile_photo_path)
                        <img src="{{ asset('storage/'.$comment->user->profile_photo_path) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-[10px] font-bold opacity-30">{{ substr($comment->user->name, 0, 2) }}</span>
                    @endif
                </div>
                <div class="flex-grow">
                    <div class="flex items-center justify-between mb-1">
                        <h4 class="text-[11px] font-bold uppercase tracking-tight text-black">{{ $comment->user->name }}</h4>
                        <span class="text-[9px] text-black/20 font-mono">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm leading-relaxed text-black/60 font-light">
                        {{ $comment->content }}
                    </p>
                </div>
            </div>
        @empty
            <div class="py-10 text-center opacity-20">
                <p class="text-xs uppercase tracking-[0.3em] font-bold">No voices yet</p>
            </div>
        @endforelse
    </div>
</div>