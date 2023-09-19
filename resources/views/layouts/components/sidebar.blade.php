<ul class="navbar-nav bg-gradient-gray sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <!--<div class="sidebar-brand-icon">
            <i class="fas fa-laugh-wink"></i>
            <img src="{{asset('images/logo.png')}}" style="height: 40px;" alt="Image">
        </div> -->
        <div class="sidebar-brand-text mx-3"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::current()->getName()=='home' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="col-md-1">{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Menu') }}
    </div>

    @if(auth()->user()->role == 'admin')
    <!-- Nav Item -->

    <li class="nav-item 
        {{ Route::current()->getName()=='admin.member.index' ? 'active' : '' }} 
        {{ Route::current()->getName()=='admin.member.create' ? 'active' : '' }}
        {{ Route::current()->getName()=='admin.member.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.member.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span class="col-md-2">{{ __('Users') }}</span>
        </a>
    </li>

    <li class="nav-item 
        {{ Route::current()->getName()=='admin.supplier.index' ? 'active' : '' }} 
        {{ Route::current()->getName()=='admin.supplier.create' ? 'active' : '' }}
        {{ Route::current()->getName()=='admin.supplier.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.supplier.index') }}">
            <i class="fas fa-fw fa-truck"></i>
            <span class="col-md-2">{{ __('Supplier') }}</span>
        </a>
    </li>

    <li class="nav-item 
        {{ Route::current()->getName()=='admin.client.index' ? 'active' : '' }} 
        {{ Route::current()->getName()=='admin.client.create' ? 'active' : '' }}
        {{ Route::current()->getName()=='admin.client.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.client.index') }}">
            <i class="fas fa-fw fa-handshake"></i>
            <span class="col-md-2">{{ __('Client') }}</span>
        </a>
    </li>

    <li class="nav-item 
        {{ Route::current()->getName()=='admin.inventory.index' ? 'active' : '' }} 
        {{ Route::current()->getName()=='admin.inventory.create' ? 'active' : '' }}
        {{ Route::current()->getName()=='admin.inventory.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.inventory.index') }}">
            <i class="fa fa-cubes"></i>
            <span class="col-md-2">{{ __('Inventory') }}</span>
        </a>
    </li>

    <li class="nav-item 
        {{ Route::current()->getName()=='admin.purchase.index' ? 'active' : '' }} 
        {{ Route::current()->getName()=='admin.purchase.create' ? 'active' : '' }}
        {{ Route::current()->getName()=='admin.purchase.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.purchase.index') }}">
            <i class="fa fa-store"></i>
            <span class="col-md-2">{{ __('Purchase Order') }}</span>
        </a>
    </li>

    <li class="nav-item 
        {{ Route::current()->getName()=='admin.proforma.index' ? 'active' : '' }} 
        {{ Route::current()->getName()=='admin.proforma.create' ? 'active' : '' }}
        {{ Route::current()->getName()=='admin.proforma.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.proforma.index') }}">
            <i class="fa fa-file-invoice"></i>
            <span class="col-md-2">{{ __('Proforma Invoice') }}</span>
        </a>
    </li>

    <li class="nav-item
        {{ Route::current()->getName()=='admin.invoice.index' ? 'active' : '' }} 
        {{ Route::current()->getName()=='admin.invoice.create' ? 'active' : '' }}
        {{ Route::current()->getName()=='admin.invoice.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.invoice.index') }}">
            <i class="fa fa-money-bill"></i>
            <span class="col-md-2">{{ __('Invoice') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Route::current()->getName()=='admin.profile' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span class="col-md-2">{{ __('Profil') }}</span>
        </a>
    </li>


    @elseif(auth()->user()->role == 'member')
    <!-- Nav Item -->
    <li class="nav-item {{ Route::current()->getName()=='member.profile' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('member.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profil') }}</span>
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
