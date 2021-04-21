<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            
            <li class="{{set_active(['operator-kepegawaian.index'])}}"><a class="nav-link" href="{{route('operator-kepegawaian.index')}}">
                <i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            
            <li class="menu-header">Menu</li>
            <li class="dropdown {{set_active(['data-pegawai.add','data-pegawai.index'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Pegawai</span></a>
            <ul class="dropdown-menu">
                <li class="{{set_active(['data-pegawai.index'])}}"><a class="nav-link" href="{{route('data-pegawai.index')}}">Data Pegawai</a></li>
                <li class="{{set_active(['data-pegawai.add'])}}"><a class="nav-link" href="{{route('data-pegawai.add')}}">Tambah Pegawai</a></li>
            </ul>

            <li class="menu-header">Master Data</li>
            <li class="dropdown {{set_active(['data-jabatan.index','data-golongan.index','data-UnitKerja.index'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Master Data</span></a>
            <ul class="dropdown-menu">
                <li class="{{ set_active(['data-golongan.index']) }}"><a class="nav-link" href="{{ route('data-golongan.index') }}">Golongan</a></li>
                <li class="{{ set_active(['data-jabatan.index']) }}"><a class="nav-link" href="{{ route('data-jabatan.index') }}">Jabatan</a></li>
                <li class="{{ set_active(['data-UnitKerja.index']) }}"><a class="nav-link" href="{{route('data-UnitKerja.index')}}">Unit Kerja</a></li>       
            </ul>
        </ul>
    </aside>
    </div>