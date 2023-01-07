        @include('partials._head')

            <main>
                @yield('content')
            </main>
        
        @include('partials._scripts')

        @stack('script')
        
    </body>
</html>