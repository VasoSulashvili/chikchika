<aside>
    @if(auth()->check())
        @foreach ($usersPaginated as $user)
            <x-profile.user-link :user="$user" />
        @endforeach
        {{ $usersPaginated->links() }}
    @else
        
    @endif
</aside>