<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#0A0A2A; height: 100%;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <div class="sidebar-heading">
                Moderation
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item
                @if(str_contains(url()->current(), 'users'))
                    active
                @endif">
                <a class="nav-link collapsed" href="{{ route('admin_user_lists') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item
                @if(str_contains(url()->current(), 'books/'))
                    active
                @endif">
                <a class="nav-link collapsed" href="{{ route('admin_book_lists') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Books</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item
                @if(str_contains(url()->current(), 'bookstores'))
                    active
                @endif">
                <a class="nav-link collapsed" href="{{ route('admin_bookstore_lists') }}">
                    <i class="fas fa-fw fa-book-reader"></i>
                    <span>Bookstores</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item
                @if(str_contains(url()->current(), 'tags'))
                    active
                @endif">
                <a class="nav-link collapsed" href="{{ route('admin_tag_lists') }}">
                    <i class="fas fa-fw fa-tag"></i>
                    <span>Tags</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item
                @if(str_contains(url()->current(), 'orders'))
                    active
                @endif">
                <a class="nav-link collapsed" href="{{ route('admin_order_lists') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>

            @if (session('admin_details'))
                    <!-- Nav Item - Pages Collapse Menu -->
                @if (session('admin_details')->level == 1)
                    <li class="nav-item
                        @if (str_contains(url()->current(), 'admins'))
                            active
                        @endif">
                        <a class="nav-link collapsed" href="{{ route('admin_admin_lists') }}">
                            <i class="fas fa-fw fa-user-tie"></i>
                            <span>Admin</span>
                        </a>
                    </li>
                @else
                        <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed disabled">
                            <i class="fas fa-fw fa-user-tie"></i>
                            <span>Admin<br>- Requires level 1 moderation to access</span>
                        </a>
                    </li>
                @endif
            @else
                    <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed disabled">
                        <i class="fas fa-fw fa-user-tie"></i>
                        <span>Admin<br>- Requires level 1 moderation to access</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>