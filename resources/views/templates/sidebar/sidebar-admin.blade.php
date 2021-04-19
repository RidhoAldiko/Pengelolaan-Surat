<div class="main-sidebar sidebar-style-2">
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        
        <li class="{{set_active(['admin.index'])}}"><a class="nav-link" href="{{route('admin.index')}}">
            <i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="menu-header">Menu</li>
        <li class="dropdown {{set_active(['data-pengguna.index','data-pengguna.add'])}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Pengguna</span></a>
        <ul class="dropdown-menu">
            <li class="{{set_active(['data-pengguna.index'])}}"><a class="nav-link " href="{{route('data-pengguna.index')}}">Data Pengguna</a></li>
            <li class="{{set_active(['data-pengguna.add'])}}"><a class="nav-link" href="{{route('data-pengguna.add')}}">Tambah Pengguna</a></li>
        </ul>
    </ul>
</aside>
</div>