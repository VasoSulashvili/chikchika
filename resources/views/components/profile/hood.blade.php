<div class="mb-10">
    <div class="border border-nt-snow-3 mb-3 p-5 min-h-52">
        <div class="flex justify-end h-5">
            @can('update-profile', $profile)
            <a href="{{ route('profile.edit', ['user' => $user->name]) }}">
                <i class="bi bi-pencil-square"></i>
            </a>
            @endcan
        </div>
        <div class="flex justify-center mb-5">
            @if(isset($user->image))
                <img class="rounded border-2 border-nt-snow-3 w-32 h-32" src="{{ $user->image }}" alt="" srcset="">
            @else
                <i class="bi bi-person-circle text-9xl text-nt-snow-3"></i>
            @endif
        </div>
        <div class="flex justify-center mb-5">
            @if(isset($user->first_name, ))
            <a href="{{ route('profile.show', ['user' => $user->name]) }}">
                {{ $user->first_name . ' ' . $user->last_name }}
            </a>
            @else
            <span>{{ $user->email }}</span>
            @endif
        </div>
        
    
    </div>
    <div class="flex justify-end">
        @if(auth()->check())
            @cannot('update-profile', $profile)
                <livewire:follow-button :user="$user" />
            @endcannot
        @endif
    </div>
</div>