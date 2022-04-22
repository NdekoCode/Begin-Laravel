@include('html_partials.header')

<div class="container max-w-7xl mx-auto px-3 lg:px-0">
    @include ('flash::message')
@yield('content')
</div>

@include('html_partials.footer')
