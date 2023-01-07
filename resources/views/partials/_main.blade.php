        @include('partials._head')
        
        @include('partials._header')

            <main>
                @yield('content')
            </main>
            
        @include('partials._footer')

        @include('partials._scripts')

        @stack('script')

    </body>
</html>