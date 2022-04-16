<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.frontsite.meta')
         
        {{-- yield digunakan untuk menggabungkan / menerima blade lain dari file lain --}}
        <title>@yield('title') | MeetDoctors</title>

        {{-- Stack digunakan untuk menampilkan plugin-plugin yang kita pake untuk page tertentu --}}
        @stack('before-style')
            @include('includes.frontsite.style')
        @stack('after-style')
        
    </head>
    <body>
        @include('sweetalert::alert')
        
        @include('components.frontsite.header')
            @yield('content')
        @include('components.frontsite.footer')

        @stack('before-script')
            @include('includes.frontsite.script')
        @stack('after-script')
    </body>
</html>