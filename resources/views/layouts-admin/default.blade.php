<!DOCTYPE html>
<html>

<head>
    @include('layouts.head')
    @notifyCss
</head>

<body class="sb-nav-fixed">
    
    @include('layouts.navbar')

    <div class="container-fluid page-body-wrapper">
        @include('layouts-admin.sidebar')
        @include('notify::components.notify')
        <div class="main-panel">
            @yield('content')
            @include('layouts.footer')
        </div>

    </div>

    @include('layouts.foot')

</body>

</html>