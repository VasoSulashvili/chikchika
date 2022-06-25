<div class="my-5">
    <label class="text-sm block mb-1" for="{{ $name }}">
        {{ $label }}
    </label>
    <select class="border rounded-md border-gray-300 bg-nt-snow-0 px-4 py-1 w-full" 
    @if(isset($livewire)) wire:model="{{ $name }}" @endif
    id="{{ $name }}"
    name="{{ $name }}"
    @if(isset($value)) value="{{ $value }}" @endif>
        <option>Choose {{ $label}}</option>
        @foreach ($collections as $collection)
            <option 
                value="{{ $collection->id }} 
                @if(isset($editable) && $editable->id == $collection->id) selected @endif">
                    {{ $collection->name }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-nt-aurora-0">{{ $message }}</p>
    @enderror
</div>