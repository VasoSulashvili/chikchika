<div class="my-5">
    <label class="text-sm mb-1 mr-4 block" for="{{ $name }}">
        {{ $label }}
    </label>
    <input class="border rounded-md border-gray-300 p-2" value="1" type="checkbox" 
        id="{{ $name }}" 
        name="{{ $name }}"
        @if(isset($value) && $value == 1) checked @endif>
    @error($name)
        <p class="text-nt-aurora-0">{{ $message }}</p>
    @enderror
</div>