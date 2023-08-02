<!doctype html>
<html lang="en">

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    @include('layouts.head')
    @yield('style')
    {{-- @laravelPWA --}}
    <title>Antrian</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.navbar')
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    @include('layouts.foot')
    @yield('js')
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        $(() => {
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function(reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        })
    </script>
    <script>
        function inputToLog(text) {
            let data = {
                "panggilan": text
            };
            $.post("{{ route('logPanggilan.store') }}", data,
                function(data) {
                    console.log(data);
                },
                "json"
            );
        }

        function convertUrutan(input) {
            return input = input.replace(/(\D)0+/g, '$1 ').replace(/(\D)0+/g, '$1');
        }
    </script>
</body>

</html>
