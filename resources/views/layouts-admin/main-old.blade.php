<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts-admin.head')
        <title>@yield('title')</title>
    </head>
  <body id="page-top">
    <main>
        @include('layouts-admin.header')
        @yield('container')
        <!-- Footer -->
        {{--  <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; SeminarKu 2023</span>
                        </div>
                    </div>
                </footer>  --}}
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

    </main>
    <footer>
        @include('layouts-admin.footer')
    </footer>
  </body>
</html>