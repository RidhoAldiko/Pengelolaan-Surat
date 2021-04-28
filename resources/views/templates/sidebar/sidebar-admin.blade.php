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

        <li class="menu-header">Master Data</li>
            <li class="dropdown {{set_active(['data-jabatan.index','data-golongan.create','data-golongan.index','data-unit_kerja.index','data-level_surat.index'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Master Data</span></a>
            <ul class="dropdown-menu">
                <li class="{{ set_active(['data-golongan.index','data-golongan.create','data-golongan.edit']) }}"><a class="nav-link" href="{{ route('data-golongan.index') }}">Golongan</a></li>
                <li class="{{ set_active(['data-jabatan.index']) }}"><a class="nav-link" href="{{ route('data-jabatan.index') }}">Jabatan</a></li>
                <li class="{{ set_active(['data-unit_kerja.index']) }}"><a class="nav-link" href="{{route('data-unit_kerja.index')}}">Unit Kerja</a></li>       
                <li class="{{ set_active(['data-level_surat.index']) }}"><a class="nav-link" href="{{route('data-level_surat.index')}}">Level Surat</a></li>       
            </ul>
    </ul>
</aside>
</div>