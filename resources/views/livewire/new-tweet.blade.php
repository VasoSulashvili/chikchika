<div>
    <button class="w-full py-3 px-8 bg-nt-frost-0 rounded-full text-center text-nt-snow-0 text-xl"
        wire:click="showTweetModal()">
        Tweet
    </button>
    <div>
        @if($showTweetModal)
        <x-modals.modal-xl livewire>
            <x-forms.select livewire name="tweetCategoryId" label="Tweet Category" :collections="$tweetCategories" />
            <x-forms.textarea livewire name="tweetBody" label="Tweet" placeholder="Tweet..." />
            <div class="flex justify-end space-x-2">
                <x-buttons.button livewireCancelMethod action="cancel" name="Cancel" />
                <x-buttons.button livewireSubmitMethod action="save" name="Create" />
            </div>
        </x-modals.modal-xl>
        @endif
    </div>
</div>
