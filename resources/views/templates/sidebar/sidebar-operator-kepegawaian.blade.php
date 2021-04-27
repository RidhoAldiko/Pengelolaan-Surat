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

            {{-- <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-file"></i> <span>Dokumen Pegawai</span></a>
            <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="">Tambah Dokumen</a></li>
            </ul> --}}

            <li class="dropdown {{set_active(['riwayat-pendidikan.create'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-university"></i> <span>Riwayat Pendidikan</span></a>
            <ul class="dropdown-menu">
                <li class="{{set_active(['riwayat-pendidikan.create'])}}"><a class="nav-link" href="{{ route('riwayat-pendidikan.create') }}">Sekolah</a></li>
            </ul>
{{-- 
            <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Riwayat Keluarga</span></a>
            <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="">Suami / Istri</a></li>
                <li class=""><a class="nav-link" href="">Anak</a></li>
                <li class=""><a class="nav-link" href="">Orang Tua</a></li>
            </ul> --}}

        </ul>
    </aside>
    </div>