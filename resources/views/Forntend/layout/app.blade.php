
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="@yield('seo_meta_description')">
        <title>@yield('seo_title')</title>

        <link rel="icon" type="image/png" href="{{asset("forntend/uploads/favicon.png")}}" />

        <!-- All CSS -->
       @include('forntend.layout.styles')

       <!-- All Javascripts -->
       @include('forntend.layout.scripts')


        <link
            href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
    <!-- Your custom styles -->
    <style>
        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .phone-email {
            list-style: none;
            text-align: center;
            padding: 0;
        }

        .right-side {
            text-align: right;
        }

        .menu {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="top">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-4">
                    <nav class="navbar">
                        <a class="navbar-brand" href="#">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI2AoTENdsOWiW21lAV8teZTytNBCKULLTWA&usqp=CAU" alt="" width="30" height="24" class="d-inline-block align-text-top">
                            <span class="logo-text">Job <span class=" text-primary">Pluse</span> </span>
                        </a>
                    </nav>
                </div>

                <div class="col-md-4 phone-email">
                 
                </div>

                <div class="col-md-4 ">
                    <ul class="right text-success">
                        <li class="menu">
                            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt text-success"></i> Login</a>
                        </li>
                        <li class="menu">
                            <a href="{{ route('signup') }}"><i class="fas fa-user text-success"></i> Sign Up</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


        @include('Forntend.layout.navbar')

        @yield('main-content')

       @include('Forntend.layout.footer')

        <div class="scroll-top">
            <i class="fas fa-angle-up"></i>
        </div>

    <script src="{{asset("forntend/js/custom.js")}}"></script>
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
