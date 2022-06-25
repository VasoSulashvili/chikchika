<div  x-data="{ showTweetModal: false }">
    <button class="w-full py-3 px-8 bg-nt-frost-0 rounded-full text-center text-nt-snow-0 text-xl"
        @click="showTweetModal = true">
        Tweet
    </button>
    <div x-show="showTweetModal">
        wwwwwww
        <x-modals.modal-xl modal-name="showTweetModal">
            {{-- <x-forms.select livewire name="tweetCategoryId" label="Tweet Category" :collection="$tweetCategories" /> --}}
            sss
        </x-modals.modal-xl>
    </div>
</div>

