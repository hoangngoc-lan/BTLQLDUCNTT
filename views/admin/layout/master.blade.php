<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="Test" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>@yield('title')</title>

    @include('admin.layout.style')

    @stack('styles')
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    @include('admin.layout.header')

    <!-- Page Content -->
    @yield('content')
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@include('admin.layout.script')

@stack('scripts')

</body>

</html>
