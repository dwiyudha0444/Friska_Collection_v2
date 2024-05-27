@include('home.head')


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">
        

        @include('home.preload_search')
        @include('home.navbar')
        @include('home.mobile_menu')
        {{-- @include('home.banner') --}}
        {{-- @include('home.home') --}}
        @yield('content')
        @include('home.footer')

    </div>


    <!-- jequery plugins -->
    <script src="home/assets/js/jquery.js"></script>
    <script src="home/assets/js/popper.min.js"></script>
    <script src="home/assets/js/bootstrap.min.js"></script>
    <script src="home/assets/js/owl.js"></script>
    <script src="home/assets/js/wow.js"></script>
    <script src="home/assets/js/validation.js"></script>
    <script src="home/assets/js/jquery.fancybox.js"></script>
    <script src="home/assets/js/TweenMax.min.js"></script>
    <script src="home/assets/js/appear.js"></script>
    <script src="home/assets/js/scrollbar.js"></script>
    <script src="home/assets/js/jquery.nice-select.min.js"></script>
    <script src="home/assets/js/isotope.js"></script>

    <!-- main-js -->
    <script src="home/assets/js/script.js"></script>
</body><!-- End of .page_wrapper -->

</html>
