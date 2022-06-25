@if(auth()->check())
    <div class="py-4">
        <div x-data="{ show : false}">
            <button class="pr-4 rounded-full border border-l-0 border-nt-frost-0" @@click="show = !show">
                <i class="bi bi-person mr-4 h-full inline-block px-1 border rounded-full border-nt-frost-0"></i>
                <span class=" text-sm">
                    {{ 
                        isset(auth()->user()->profile->first_name, auth()->user()->profile->last_name) 
                        ? auth()->user()->profile->first_name . ' ' . auth()->user()->profile->last_name
                        : auth()->user()->email }}
                </span>
                
            </button>
            <!-- Links -->
            <div class="drop-shadow-lg bg-nt-snow-0 pt-4" x-show="show">
                <div class="py-2 px-4 border-t border-nt-snow-2">
                    <a href="{{ route('profile.token', ['user' => auth()->user()->name]) }}">API</a>
                </div>
                @if(is_null(auth()->user()->email_verified_at))
                <div class="py-2 px-4 border-t border-nt-snow-2">
                    {{-- <a href="{{ route('verification.resend') }}">Resend Email Verification</a> --}}
                    <form action="{{ route('verification.send') }}" method="post">
                        @csrf
                        <x-forms.button action="edit" name="Send Email Verification link" />
                    </form>
                </div>
                @endif
                <div class="py-2 px-4 border-t border-nt-snow-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif