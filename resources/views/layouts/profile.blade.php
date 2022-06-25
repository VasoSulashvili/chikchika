@extends('layouts.app')

@section('mainContent')
    <div>
        <x-profile.hood :user="$user" :profile="$profile" />
    </div>
    <div>
        @yield('profileSection')
    </div>
    
@endsection