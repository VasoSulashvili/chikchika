@extends('layouts.profile')

@section('profileSection')
    @foreach($notifications as $notification)
        <livewire:notification-item :notification="$notification" wire:key="$notification->id" />
    @endforeach
    {{ $notifications->links() }}
@endsection