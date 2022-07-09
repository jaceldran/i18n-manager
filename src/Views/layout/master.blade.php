<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>i18n Manager</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/fontawesome/css/all.min.css" />
</head>

<body>
    <header class="fixed bg-slate-800 text-white mt-0 w-full z-10 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <span class="text-white font-semibold">
                    <i class="fab fa-fly fa-2x --bg-cyan-500 text-amber-400 -rotate-12 p-1 rounded-lg mr-1"></i>
                    <span class="text-2xl">i18n manager</span>
                </span>
            </div>
            @yield('navigation-main')
            {{-- <nav class="font-semibold lowercase flex">
                <a class="p-4  bg-amber-400 text-slate-800" href="/manage">manage</a>
                <a class="p-4" href="/upload">upload</a>
                <a class="p-4" href="/config">config</a>
                <a class="p-4" href="/search">search</a>
            </nav> --}}
        </div>
    </header>

    <main class="container mx-auto mt-16">
        @yield('main')
    </main>

	@yield('script')
</body>

</html>
