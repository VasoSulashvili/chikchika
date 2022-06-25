<div>
    <livewire:new-comment />
    
    <div class="mb-10">
        <input id="tweet-category-input" type="hidden" name="" value="">
        <select wire:model="categoryId" class="w-full border border-gray-100 text-gray-600 mb-1" name="tweet_category_id" id="tweet-category-select">
            <option value="" id="tweet-category-select">All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    @foreach ($tweets as $tweet)
        <div class="mb-7" :wire:key="$tweet->id">
            <div class="flex justify-between px-4 py-1 bg-nt-snow-3 text-sm">
                <a href="{{ route('profile.show', ['user' => $tweet->user_name]) }}">
                    <i class="bi bi-person mr-2"></i>
                    <span>{{ $tweet->user_email }}</span>
                </a>
                <span><i class="bi bi-calendar-event mr-2"></i> {{ $tweet->tweet_created_at }}</span>
            </div>
            <div class="p-4">
                {{$tweet->body}}
            </div>
            <div class="flex justify-between px-4 py-1 bg-nt-snow-1 text-sm">
                <div class="flex space-x-8">
                    <button wire:click="like({{ $tweet->tweet_id }})">
                        @if($this->authUserLikesTweet($tweet->tweet_id) === TWEET_LIKE)
                            <i class="bi bi-hand-thumbs-up-fill cursor-pointer"></i>
                        @else
                            <i class="bi bi-hand-thumbs-up cursor-pointer" ></i>
                        @endif
                        <span>{{ $this->countLike($tweet->tweet_id) }}</span>
                    </button>
                    <button wire:click="unlike({{$tweet->tweet_id}})">
                        @if($this->authUserLikesTweet($tweet->tweet_id) === TWEET_UNLIKE)
                        <i class="bi bi-hand-thumbs-down-fill cursor-pointer"></i>
                        @else
                        <i class="bi bi-hand-thumbs-down cursor-pointer"></i>
                        @endif
                        <span>{{ $this->countUnlike($tweet->tweet_id) }}</span>
                    </button>

                    <div>
                        <i class="bi bi-chat-left-dots" wire:click="createComment({{ $tweet->tweet_id }})"></i>
                        <span>{{ $this->countComment($tweet->tweet_id) }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('tweet.show', ['user' => $tweet->user_name, 'tweet' => $tweet->tweet_id]) }}">
                    <i class="bi bi-eye"></i>
                </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($tweets->hasMorePages())
        <button wire:click.prevent="loadMore">Load more</button>
    @endif
</div>
