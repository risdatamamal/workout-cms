<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | MY GYM</title>
	<!-- initiate head with meta tags, css and script -->
	@include('includes.head')

</head>
<body id="app" >
    <div class="wrapper">
    	<!-- initiate header-->
    	@include('includes.header')
    	<div class="page-wrap">
	    	<!-- initiate sidebar-->
	    	@include('includes.sidebar')

	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

	    	<!-- initiate chat section-->
	    	@include('includes.chat')


	    	<!-- initiate footer section-->
	    	@include('includes.footer')

    	</div>
    </div>

	<!-- initiate modal menu section-->
	@include('includes.modalmenu')

	<!-- initiate scripts-->
	@include('includes.script')
</body>
</html>
