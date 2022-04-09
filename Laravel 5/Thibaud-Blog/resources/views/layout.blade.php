@include('html_partials.header')

<div class="container max-w-7xl mx-auto px-3 lg:px-0">
    
    @if($errors->has('global_errors'))
    <div class="bg-red-100 border border-red-300 rounded text-sm text-red-500 mb-3 px-2 py-3 m-5">{{ $errors->first('global_errors') }}</div>
    @endif
@yield('content')
</div>

@include('html_partials.footer')
