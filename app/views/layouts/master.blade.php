@if(!Request::ajax())
	@include('layouts._header')
@endif
@yield('content')
@if(!Request::ajax())
	@include('layouts._footer')
@endif
