<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cemre Bakery - Restorant Html Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Cemre Tellioğlu Tunçay">
    <title>@yield('title')</title>

    @include('bakery.layout.style')

    @stack('styles')
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    @include('bakery.layout.header')

    <!-- Page Content -->
    
    @yield('content')
    <!-- /#page-wrapper -->
  
    @include('bakery.layout.footer')
     
</div>
<!-- /#wrapper -->

        

@include('bakery.layout.script')
  

@stack('scripts')

</body>

</html>
