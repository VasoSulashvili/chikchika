<div>
    <div class="absolute top-0 left-0 w-full h-full bg-nt-polar-3 bg-opacity-50"
    @if(isset($livewire)) wire:click="livewireCancel" 
    @elseif(isset($modalName)) 
    @click="{{ $modalName }} = false"
    @endif>
    </div>
    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 
        bg-opacity-100 bg-nt-snow-3 w-1/2 min-h-full">
        <div class="flex justify-end py-4 px-10">
            <i class="bi bi-x-lg text-nt-aurora-0 text-xl cursor-pointer" 
                @if(isset($livewire)) wire:click="livewireCancel" 
                @elseif(isset($modalName)) 
                @click="{{ $modalName }} = false"
                @endif>
            </i>
        </div>
        <div class="px-10 pt-7 pb-10">
            {{ $slot }}
        </div>
        
    </div>
</div>
