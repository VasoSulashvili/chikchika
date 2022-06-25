<div class="mb-3 @if($status) bg-nt-snow-1 @else bg-nt-snow-3 @endif px-2 py-1">
    <div class="flex justify-between">
        <div>
            <span>
                <i class="{{ $icon }} text-lg mr-2"></i>
            </span>
            <span>User </span>
            <a class="underline text-nt-frost-3" href="{{ route('profile.show', ['user' => $fromUser->name]) }}">
                <span>{{ $userName }} </span>
            </a>
            <span>{{ $action }} </span>
            <span>at {{ $date }} </span>
        </div>
        <div class="ml-4">
            <button wire:click="updateStatus()">
                @if($status)
                <i class="bi bi-eye text-lg"></i>
                @else
                <i class="bi bi-eye-slash text-lg"></i>
                @endif
            </button>
        </div>
    </div>
</div>
