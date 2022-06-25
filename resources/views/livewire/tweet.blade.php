<div class="">
    <div class="p-10 bg-nt-snow-0 text-xl">
        {{ $tweet->body }}
    </div>
    <div class="flex justify-between px-4 py-1 bg-nt-snow-1 text-sm">
        <div class="flex space-x-8">
            <button wire:click="like()">
                @if($this->authUserLikesTweet() === TWEET_LIKE)
                    <i class="bi bi-hand-thumbs-up-fill cursor-pointer"></i>
                @else
                    <i class="bi bi-hand-thumbs-up cursor-pointer" ></i>
                @endif
                <span>{{ $this->countLike() }}</span>
            </button>
            <button wire:click="unlike()">
                @if($this->authUserLikesTweet() === TWEET_UNLIKE)
                <i class="bi bi-hand-thumbs-down-fill cursor-pointer"></i>
                @else
                <i class="bi bi-hand-thumbs-down cursor-pointer"></i>
                @endif
                <span>{{ $this->countUnlike() }}</span>
            </button>

            <div>
                <i class="bi bi-chat-left-dots"></i>
                <span>{{ $countComments }}</span>
            </div>
        </div>
        <div>
        </div>
    </div>
    <div>
        <div>
            <x-forms.textarea livewire name="commentBody" label="" placeholder="New Comment" />
            <div class="flex justify-end">
                <button class="rounded-md text-white px-5 py-1 text-sm bg-nt-aurora-3"
                    wire:click="createComment" >
                    Create Comment
                </button>
            </div>
        </div>
        @foreach ($comments as $comment)
        <div class="my-10 border-b border-nt-snow-3" :key="$comment->id . now()">
            <div class="flex justify-between px-4 py-1 bg-nt-snow-1 text-sm">
                @if( isset($comment->user_first_name,  $comment->user_last_name))
                <span>{{ $comment->user_first_name . ' ' . $comment->user_last_name }}</span>
                @else
                <span>{{ $comment->user_email }}</span>
                @endif
                <span>{{ $comment->created_at }}</span>
            </div>
            <div class="px-4 py-1 bg-nt-snow-0 text-sm">
                {{ $comment->body }}
            </div>
        </div>
            
        @endforeach
    </div>
</div>
