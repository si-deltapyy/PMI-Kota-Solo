<!DOCTYPE html>
<html>

<head>
    @include('layouts.head')
    @notifyCss
</head>

<body class="sb-nav-fixed">

    @include('layouts.navbar')

    <div class="container-fluid page-body-wrapper">
        @include('layouts-pengelolaProfil.sidebar')

        @include('notify::components.notify')

        @yield('content')

        @include('layouts.footer')

        @include('layouts.foot')
    </div>

</body>

</html>