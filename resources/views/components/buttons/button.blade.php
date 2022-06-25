<div>
    <button class="rounded-md text-white px-5 py-1 text-sm
    @if($action == 'save') bg-nt-aurora-3
    @elseif($action == 'cancel') bg-nt-aurora-1
    @elseif($action == 'edit') bg-nt-polar-3
    @elseif($action == 'delete') bg-nt-aurora-0
    @endif"
    @if(isset($livewireSubmitMethod)) wire:click="livewireSubmit()" @endif
    @if(isset($livewireCancelMethod)) wire:click="livewireCancel()" @endif
    @if(isset($submit)) type="submit" @endif >
        {{ $name }}
    </button>
</div>
