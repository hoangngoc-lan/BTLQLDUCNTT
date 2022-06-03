<header class="top">
    <div class="content-wrapper">
        <!-- Main Menu Start -->
        <!-- Navbar-->
        <nav class="navbar navbar-default myNavBar" style="background-color: #343434; margin-bottom: 0px; border-radius: 0px; justify-content: left;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style='width: 100%;'>
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="row">
                            <a style="padding-top:0px;" class="navbar-brand" href="{{ route('home') }}">
                                <img src="/bakery/img/logo/book_logo.png" style="height: 100%;">
                            </a>
                        </div>
                    </div>
                    <div class="
                        @if (session('user_details')) col-sm-6 col-md-6 col-lg-6 col-xl-6
                        @else col-sm-5 col-md-5 col-lg-5 col-xl-5
                        @endif">
                        <form method="POST" action="{{ route('search_store') }}">
                            @csrf
                            <div style="display: inline-flex; border-radius: 40px; background-color: none; padding: 2px; border: 1px solid lightgray; width: 100%;">
                                <input type="text" name="search" style="width: 100%; color: white; outline: none; border: none; background-color: transparent; padding: 10px; height: 40px;">
                                <button class="btn btn-warning" style="border-radius: 40px; height: 40px;">Search</button>
                            </div>
                            <input type="hidden" name="type" value="book_name">
                            <input type="hidden" name="bookstore" value="-1">
                            <input type="hidden" name="tags" value="">
                        </form>
                    </div>
                    @if (session('user_details'))
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav d-flex" style="flex-direction: row; float: right;">
                                    <li class="nav-item mx-2"><a href='{{ route('home') }}' class="nav-link text-uppercase font-weight-bold js-scroll-trigger">HOME</a></li>
                                    <li class="mx-2" style="width: 35px;">
                                        <div class="py-2">
                                            <a href="#/" class="py-0" data-toggle="dropdown" id="my_account_btn">
                                                <img src="{{ asset(session('user_details')->image) }}" class="pfp rounded-pill">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="my_account_btn" style="position: absolute;">
                                                <a class="dropdown-item" href="{{ route('user_settings') }}">
                                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Acount setting
                                                </a>
                                                <a class="dropdown-item" href="{{ route('cart') }}">
                                                    <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Cart
                                                </a>
                                                <a class="dropdown-item" href="{{ route('user_orders') }}">
                                                    <i class="fas fa-box fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Orders
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="{{ route('logout') }}">Log out</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav d-flex" style="flex-direction: row; float: right;">
                                    <li class="nav-item mx-2"><a href='{{ route('home') }}' class="nav-link text-uppercase font-weight-bold js-scroll-trigger">HOME</a></li>
                                    <li class="nav-item mx-2"><a href='{{ route('signup') }}' class="nav-link text-uppercase font-weight-bold js-scroll-trigger">SIGN UP</a></li>
                                    <li class="nav-item mx-2"><a href='{{ route('login') }}' class="nav-link text-uppercase font-weight-bold js-scroll-trigger">LOGIN</a></li>
                                    <li class="nav-item mx-2"><a href='{{ route('login') }}' class="nav-link text-uppercase font-weight-bold js-scroll-trigger">ADMIN LOGIN</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <!-- Main Menu End -->
    </div>
</header>
    <!-- Header Area End -->
    <!-- Section0 Area Start -->
        
