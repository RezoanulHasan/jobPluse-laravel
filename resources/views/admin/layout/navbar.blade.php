<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right w-100-p justify-content-end">
        <li class="nav-link">
            <a href="" target="_blank" class="btn btn-warning">Front End</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{asset('admin/uploads/'.Auth::guard('admin')->user()->photo)}}" class="rounded-circle-custom mr-1" alt="images">
                <div class="d-sm-none d-lg-inline-block">{{Auth::guard('admin')->user()->name}}</div>
            </a>
            <ul class="dropdown-menu dropdown-menu-light">
                <li><a href="{{route('admin_profile')}}" class="dropdown-item "><i class="far fa-user">Edit Profile</i></a></li>
                <li><a href="{{route('admin_logout')}}" class="dropdown-item text-danger pr-2"><i class="fas fa-sign-out-alt">Logout</i></a></li>
            </ul>
        </li>
    </ul>
</nav>
