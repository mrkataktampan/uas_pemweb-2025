<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.partials.head')
</head>
<body>

    @include('components.partials.nav')

    @yield('content')

    @include('components.partials.footer')
    @include('components.partials.copyright')
    @include('components.partials.script')

</body>
</html>