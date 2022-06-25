<aside>
    @if(!auth()->check())
        <div x-data="{ auth: 'login' }">
            <div x-show="auth == 'login'" ><x-auth.login /></div>
            <div x-show="auth == 'register'" ><x-auth.register /></div>
        </div>
    @else
    <ul class="mt-6 pl-6 text-xl text-gray-700">
        {{-- {{ route("home.page", ["user" => 'dddd']) }} --}}
        <x-navs.item 
            route-name="home" 
            title="Home" 
            icon="bi bi-house" />
        <x-navs.item 
            route-name="user.notifications" 
            :route-params="['user' => auth()->user()->name]" 
            title="Notifications" 
            icon="bi bi-bell" 
            :sum="$unseenNotifications->count()" 
            id="nav_notification" />
        <x-navs.item 
            route-name="profile.show" 
            :route-params="['user' => auth()->user()->name]" 
            title="Profile" 
            icon="bi bi-person" />
    </ul>
    <div class="mt-12">
        <livewire:new-tweet />
        
        
    </div>
    @endif
</aside>