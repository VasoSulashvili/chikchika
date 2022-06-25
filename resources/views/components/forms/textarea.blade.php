<div class="my-5">
    <label class="text-sm block mb-1" for="{{ $name }}">
        {{ $label }}
    </label>
    <textarea class="border rounded-md border-gray-300 bg-nt-snow-0 px-4 py-1 w-full h-44" 
    @if(isset($livewire)) wire:model="{{ $name }}" 
    @else name="{{ $name }}" 
    @endif
    id="{{ $name }}"
    placeholder="{{ $placeholder }}"
    >@if(isset($value)) value="{{ $value }}" @endif</textarea>
    @error($name)
        <p class="text-nt-aurora-0">{{ $message }}</p>
    @enderror
</div>