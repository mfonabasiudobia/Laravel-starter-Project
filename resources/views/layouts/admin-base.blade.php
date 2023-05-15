<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="noindex" />
    @stack('meta_data')

    <link rel="shortcut icon" href="{{ asset('storage/images/logo/logo.png') }}" type="image/x-icon">

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('header')

    @livewireStyles
    {{-- @powerGridStyles --}}

</head>

<body>
    <livewire:toasts />
    <section class="page-wrapper bg-light dark:bg-dark dark:text-white h-screen overflow-y-auto"
        x-data="{ toggleSidebar : true}">
        <section class="flex">
            @if(!AppHelper::isAdminAuthRoute())
            @livewire("admin.partials.sidebar")
            @endIf
            <div class="overflow-y-auto w-full min-h-screen">
                @if(!AppHelper::isAdminAuthRoute())
                @livewire("admin.partials.header")
                @endIf
                <div class="p-3 md:p-5">
                    {{$slot}}
                </div>
            </div>
        </section>
    </section>




    {{-- @powerGridScripts --}}
    @livewireScripts
    @toastScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
    <script defer src="{{asset('js/js.js')}}?v={{uniqid()}}"></script>

    @stack("script")


</body>

</html>