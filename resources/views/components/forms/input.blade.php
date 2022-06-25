<div class="my-5">
    <label class="text-sm block mb-1" for="{{ $name }}">
        {{ $label }}
        @if(isset($required))
        <span class="text-nt-aurora-0"> *</span>
        @endif
    </label>
    <input class="border rounded-md border-gray-300 bg-nt-snow-0 px-4 py-1 w-full" 
        @if(isset($livewire)) wire:model="{{ $name }}" @endif
        id="{{ $name }}" 
        type="{{ $type }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}"
        @if(isset($value)) value="{{ $value }}" @endif>
        @error($name)
            <p class="text-nt-aurora-0">{{ $message }}</p>
        @enderror
</div>