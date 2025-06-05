<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('storage/'.auth()->user()->profile)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('student.profile')}}" class="d-block">{{auth()->user()->fname.' '.auth()->user()->lname}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                
                @can('dashboard-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('dashboard.first')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard First</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                
                @canany(['user-list','user-create'])
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                            &nbsp;<i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user-list')
                                <li class="nav-item">
                                    <a href="{{route('user.index')}}" class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
                                        &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp;
                                        <p>User List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('user-create')
                                <li class="nav-item">
                                    <a href="{{route('user.create')}}" class="nav-link {{ Route::is('user.create') ? 'active' : '' }}">
                                        &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                        <p>Create User</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['category-list','category-create'])
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
                        &nbsp;<i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;
                            <p>
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('category-list')
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link {{ Route::is('categories.index') ? 'active' : '' }}">
                                    &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp;
                                    <p>Categories List</p>
                                </a>
                            </li>
                            @endcan
                            @can('category-create')
                            <li class="nav-item">
                                <a href="{{route('categories.create')}}" class="nav-link {{ Route::is('categories.create') ? 'active' : '' }}">
                                    &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                    <p>Create Category</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['publisher-list','publisher-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('publishers*') ? 'active' : '' }}">
                        &nbsp;<i class="fas fa-newspaper"></i>&nbsp;
                        <p>
                            Publishers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('publisher-list')
                        <li class="nav-item">
                            <a href="{{route('publishers.index')}}" class="nav-link {{ Route::is('publishers.index') ? 'active' : '' }}">
                                &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp;
                                <p>Publishers List</p>
                            </a>
                        </li>
                        @endcan
                        @can('publisher-create')
                        <li class="nav-item">
                            <a href="{{route('publishers.create')}}" class="nav-link {{ Route::is('publishers.create') ? 'active' : '' }}"  >
                                &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                <p>Create Publisher</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['author-list','author-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('authors*') ? 'active' : '' }}">
                        &nbsp;<i class="fas fa-pen-nib"></i>&nbsp;
                        <p>
                            Authors
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('author-list')
                        <li class="nav-item">
                            <a href="{{route('authors.index')}}" class="nav-link {{ Route::is('authors.index') ? 'active' : '' }}">
                                &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp; 
                                <p>Authors List</p>
                            </a>
                        </li>
                        @endcan
                        @can('author-create')
                        <li class="nav-item">
                            <a href="{{route('authors.create')}}" class="nav-link {{ Route::is('authors.create') ? 'active' : '' }}"  >
                                &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                <p>Create Authors</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['book-list','book-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('books*') ? 'active' : '' }}">
                        &nbsp;<i class="fas fa-book"></i>
                        &nbsp;
                        <p>
                            Books
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('book-list')
                        <li class="nav-item">
                            <a href="{{route('books.index')}}" class="nav-link {{ Route::is('books.index') ? 'active' : '' }}">
                                &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp; 
                                <p>Books List</p>
                            </a>
                        </li>
                        @endcan
                        @can('book-create')
                        <li class="nav-item">
                            <a href="{{route('books.create')}}" class="nav-link {{ Route::is('books.create') ? 'active' : '' }}"  >
                                &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                <p>Create books</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['bookloan-list','bookloan-create'])
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('book-loans*') ? 'active' : '' }}">
                            &nbsp;<i class="fas fa-book"></i>
                            &nbsp;
                            <p>
                                Book Loans
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('bookloan-list')
                            <li class="nav-item">
                                <a href="{{route('book-loans.index')}}" class="nav-link {{ Route::is('book-loans.index') ? 'active' : '' }}">
                                    &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp; 
                                    <p>Book loans List</p>
                                </a>
                            </li>
                            @endcan
                            @can('bookloan-create')
                            <li class="nav-item">
                                <a href="{{route('book-loans.create')}}" class="nav-link {{ Route::is('book-loans.create') ? 'active' : '' }}"  >
                                    &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                    <p>Create Book loans</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['role-list','permission-list'])
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('permissions*') ? 'active' : '' }} {{ Request::is('roles*') ? 'active' : '' }}">
                        &nbsp;<i class="fas fa-book"></i>
                        &nbsp;
                        <p>
                            User Roles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('permission-list')
                            <li class="nav-item">
                                <a href="{{route('permissions.index')}}" class="nav-link {{ Route::is('permissions.index') ? 'active' : '' }}">
                                    &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp; 
                                    <p>Permission List</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{route('roles.index')}}" class="nav-link {{ Route::is('roles.index') ? 'active' : '' }}"  >
                                    &nbsp;<i class="fa fa-list" aria-hidden="true"></i>&nbsp;
                                    <p>Role List</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                {{-- @endif --}}
                <li class="nav-item active">
                    <a href="{{route('student.profile')}}" class="nav-link">
                     &nbsp;<i class="fa fa-id-badge" aria-hidden="true"></i>&nbsp;
                        Profile
                    </a>
                </li>

                <li class="nav-item active">
                    <a href="{{route('change.password')}}" class="nav-link">
                     &nbsp;<i class="fa fa-lock" aria-hidden="true"></i>&nbsp;
                        Change Password
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;
                        Logout
                    </a>
                
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
