<div class="flex items-center space-x-3 my-2">
    <div class="border-2 border-nt-snow-3 rounded-full w-9 h-9">
        {{-- @if(!is_null($user->profile->img))
        <img src="{{ $user->profile->img }}" alt="{{ $user->email }}">
        @else --}}
        <i class="bi bi-person w-full h-full text-3xl"></i>
        {{-- @endif --}}
    </div>
    <div class="align-middle">
        <a href="/{{ $user->name }}">
        {{ $user->email }}
        </a>
    </div>
</div>