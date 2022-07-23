<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>i18n Manager</title>
    <link rel="stylesheet" href= "@asset('css/style.css')" />
    <link rel="stylesheet" href="@asset('css/fontawesome/css/all.min.css')" />
    <link rel="stylesheet" href="@asset('css/flags/css/flag-icons.min.css')" />
    @yield('style')
    <style>
        dialog::backdrop {
            position: fixed;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            background: rgba(0, 255, 0, 0.1);
        }
    </style>
</head>

<body class="antialiased {{$theme->body}} selection:bg-fuchsia-300 selection:text-fuchsia-900">
    <header class="fixed   mt-0 w-full z-10 top-0 shadow-lg {{$theme->header->bg}}">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="flex items-center">
                <i class="fab fa-avianex fa-2x {{$theme->header->logo}} p-2 rounded-md mr-1"></i>
                <span class="text-white text-3xl">i18n</span>
            </a>

            @yield('navigation-main')
        </div>
    </header>

    <main class="mt-14">
        @yield('actions-bar')
        <div class="container mx-auto">
            @yield('main')
        </div>
    </main>


    {{-- <script>
        var uuid = new DeviceUUID().get();
    </script> --}}

	@yield('script')

    {{-- @include('components.modal')
    <script>
        var dialog = document.querySelector('dialog');

        function openDialog() {
            dialog.showModal();
        }

        function closeDialog() {
            dialog.close();
        }
    </script> --}}

</body>

</html>
