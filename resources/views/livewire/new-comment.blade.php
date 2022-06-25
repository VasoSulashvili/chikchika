<div>
    <div>
        @if($showCommentModal)
        <x-modals.modal-xl livewire>
            <x-forms.textarea livewire name="comment" label="Tweet" placeholder="Tweet..." />
            <div class="flex justify-end space-x-2">
                <x-buttons.button livewireCancelMethod action="cancel" name="Cancel" />
                <x-buttons.button livewireSubmitMethod action="save" name="Create" />
            </div>
        </x-modals.modal-xl>
        @endif
    </div>
</div>
