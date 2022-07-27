<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>i18n manager</title>
    <link rel="stylesheet" href= "@asset('css/style.css')" />
    <link rel="stylesheet" href="@asset('css/fontawesome/css/all.min.css')" />
    <link rel="stylesheet" href="@asset('css/flags/css/flag-icons.min.css')" />
    <link rel="icon" href="@asset('img/ultralight-16px.png')" type="image/png">
    @yield('style')
</head>

<body class="antialiased {{$theme->body}} selection:bg-fuchsia-300 selection:text-fuchsia-900">
    <header class="fixed   mt-0 w-full z-10 top-0 shadow-lg {{$theme->header->bg}}">
        <div class="container mx-auto flex justify-between transition-all">
            <a href="/" class="flex items-center">
                <img alt="logo" src="@asset('img/ultralight-32px.png')" class="rotate-45 mr-4"/>
                {{-- <i class="fab fa-avianex fa-2x {{$theme->header->logo}} p-2 rounded-md mr-1"></i> --}}
                <span class="text-white text-3xl">i18n</span>
            </a>

            @yield('navigation-main')
        </div>
    </header>

    <main class="mt-14">
        @yield('actions-bar')
        <div class="container mx-auto transition-all">
            @yield('main')
        </div>
    </main>


    {{-- <script>
        var uuid = new DeviceUUID().get();
    </script> --}}

	@yield('script')

</body>

</html>
