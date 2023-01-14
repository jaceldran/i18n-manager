<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>i18n Manager</title>
    <link rel="icon" href="@asset('img/ultralight-16px.png')" type="image/png">
    <link rel="stylesheet" href="@asset('css/style.css')" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.4/css/flag-icons.min.css"
        integrity="sha512-uvXdJud8WaOlQFjlz9B15Yy2Au/bMAvz79F7Xa6OakCl2jvQPdHD0hb3dEqZRdSwG4/sknePXlE7GiarwA/9Wg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('style')
    <script src="https://kit.fontawesome.com/9449d5f4ab.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased {{ $theme->body }} selection:bg-violet-800 selection:text-violet-300">
    <header class="fixed   mt-0 w-full z-10 top-0 shadow-lg {{ $theme->header->bg }}">
        <div class="container mx-auto flex justify-between transition-all">
            <a href="/" class="flex items-center">
                <img alt="logo" src="@asset('img/ultralight-32px.png')" class="rotate-45 mr-3" />
                <span class="text-white text-3xl font-fjalla-one">
                    <span class="">i18n</span><span class="text-amber-500">manager</span>
                </span>
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
