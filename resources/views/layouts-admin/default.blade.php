<!DOCTYPE html>
<html>

<head>
    @include('layouts.head')
</head>

<body class="sb-nav-fixed">

    @include('layouts.navbar')

    <div class="container-fluid page-body-wrapper">
        @include('layouts-admin.sidebar')

        <div class="main-panel">
            @yield('content')
            @include('layouts.footer')
        </div>

    </div>

    @include('layouts.foot')

</body>

</html>