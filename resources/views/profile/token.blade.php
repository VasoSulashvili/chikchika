@extends('layouts.profile')

@section('profileSection')
    <div>
        <form action="{{ route('profile.token.create', ['user' => auth()->user()->name]) }}" method="POST">
            @csrf
            <p>Copy: <span class="px-4 py-1 bg-nt-polar-3 text-nt-snow-0">{{ isset($user_token) ? $user_token : '' }}</span></p>
            
            
            <button type="submit">Generate</button>
        </form>
    </div>

@endsection