<!doctype html>
<html lang="en">
<head>
    @include('includes.head')
    @yield('style')
</head>
<body>

<section class="content" id="content">
<div class="container">
    @yield('content')
</div>
</section>

@include('includes.script')
@stack('script')
@yield('script')
</body>
</html>
</body>
</html>