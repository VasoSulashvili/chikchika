@extends('layouts.app')

@section('mainContent')
    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <x-forms.button action="edit" name="Send Email Verification link" />
    </form>
@endsection