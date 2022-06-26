<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ChikChika</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <!-- Livewire -->
    @livewireStyles
    <!-- Alpine -->
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
</head>
<body>
    @if(auth()->check())
    <input hidden id="auth-user-id" value="{{ auth()->user()->id }}" />
    @endif
    <x-layouts.__header />
    <div class="grid grid-cols-12 gap-4 bg-nt-snow-0 max-w-7xl mx-auto">
        <div class="col-span-3">
            <x-layouts.__left />
        </div>
        <div class="col-span-6">
            @yield('mainContent')
        </div>
        <div class="col-span-3">
            <x-layouts.__right />
        </div>
    </div>
   <div x-data="{ pageErrorShow : '{{ isset($pageError) ? $pageError : false }}' }">
    <div x-show="pageErrorShow">ssssssssssssssss</div>

   </div>
   @livewireScripts
</body>
</html>