<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('admin/uploads/favicon.png') }}">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Styles including here --}}
    @include('admin.layout.styles')

    {{-- Scripts including here --}}
    @include('admin.layout.scripts')

</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            <div class="navbar-bg"></div>

            {{-- Navbar Include Here --}}
            @include('admin.layout.navbar')

            {{-- Sidebar Include Here --}}
            @include('admin.layout.sidebar')


            <div class="main-content">
                <section class="section">
                    <div class="section-header justify-content-between">
                        <h1>@yield('heading')</h1>
                        @yield('button')
                    </div>

                    {{-- Main content --}}
                    @yield('content')
                </section>
            </div>

        </div>
    </div>
    {{-- Footer Scripts  --}}
    @include('admin.layout.footer_scripts')


    @if ($errors->any())
        @foreach ($errors->all() as $error)

        <script>
            iziToast.error({
                title: '',
                message: '{{ $error }}',
                position: 'topRight'
            });
        </script>

        @endforeach
    @endif

    {{-- For single error --}}
    @if (session()->get('error'))
    <script>
        iziToast.error({
            title: '',
            message: '{{ session()->get('error') }}',
            position: 'topRight'
        });
    </script>
    @endif

    {{-- For Success --}}
    @if (session()->get('success'))
    <script>
        iziToast.success({
            title: '',
            message: '{{ session()->get('success') }}',
            position: 'topRight'
        });
    </script>
    @endif

</body>
</html>
