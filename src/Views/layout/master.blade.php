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
    <script src="@asset('js/device-uuid.min.js')"></script>
</head>

<body class="antialiased">
    <header class="fixed bg-slate-800 mt-0 w-full z-10 top-0 shadow-lg">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="flex items-center">
                <i class="fab fa-fly fa-2x text-amber-400 -rotate-12 -bg-amber-600 p-2 rounded-md mr-1"></i>
                <span class="text-white text-3xl">i18n</span>
            </a>

            @yield('navigation-main')
        </div>
    </header>

    <main class="container mx-auto mt-16">
        @yield('main')

        <p><span id="fingerprint"></span></p>
        <p><span id="fingerprint-2"></span></p>
        <p><span id="fingerprint-3"></span></p>

    </main>


    <script>
        var uuid = new DeviceUUID().get();
    </script>

	@yield('script')
</body>

</html>
