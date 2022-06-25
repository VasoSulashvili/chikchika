@extends('layouts.profile')

@section('profileSection')
<form action="{{ route('profile.update', ['user' => $user->name]) }}" method="post">
    @csrf
    @method("PUT")

    <x-forms.input type="text" name="first_name" :value="$profile->first_name" label="First Name" placeholder="Enter First Name" />
    <x-forms.input type="text" name="last_name" :value="$profile->last_name" label="Last Name" placeholder="Enter Last Name" />
    <x-forms.checkbox name="public" :value="$profile->public" label="Check if public" />

    <div class="flex justify-end">
        <x-forms.button submit action="save" name="Save" />
    </div>
</form>
@endsection