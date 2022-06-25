@extends('layouts.profile')

@section('profileSection')
    <livewire:tweets :user="$user" />
@endsection