<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.auth.meta')
         
        {{-- yield digunakan untuk menggabungkan / menerima blade lain dari file lain --}}
        <title>Sign In | MeetDoctors</title>

        {{-- Stack digunakan untuk menampilkan plugin-plugin yang kita pake untuk page tertentu --}}
        @stack('before-style')
            @include('includes.frontsite.style')
        @stack('after-style')
    </head>
    <body>
        @include('components.frontsite.header')
            Home
        @include('components.frontsite.footer')

        @stack('before-script')
            @include('includes.frontsite.script')
        @stack('after-script')
    </body>
</html>