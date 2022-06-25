<i class="py-2 block text-xl">
    @if(auth()->check())
    <a href="{{ route($routeName, isset($routeParams) ? $routeParams : []) }}">
        <i class="{{ $icon }} mr-4 @if( explode('.',$viewRouteName)[0] == explode('.', $routeName)[0]) text-nt-aurora-3 @else text-nt-polar-3 @endif"></i>
        <span class="not-italic text-xl @if( $viewRouteName == $routeName) text-nt-aurora-3 @else text-nt-polar-3 @endif">
            {{ $title }}
            @if(isset($sum))
            <span class="border bg-nt-frost-3 text-nt-snow-0 rounded-full px-2 text-xs inline-block text-center align-middle" id="{{ isset($id) ? $id : null }}">{{ $sum }}</span>
            @endif
        </span>
    </a>
    @endif
</i>