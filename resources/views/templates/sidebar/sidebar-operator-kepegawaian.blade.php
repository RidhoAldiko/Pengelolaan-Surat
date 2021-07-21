<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">UMSETKPR</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">KPR</a>
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

            <li class="dropdown {{set_active(['pegawai-organisasi.create','kursus-atau-pelatihan.create','riwayat-pendidikan.create'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-university"></i> <span>Riwayat Pendidikan</span></a>
            <ul class="dropdown-menu">
                <li class="{{set_active(['riwayat-pendidikan.create'])}}"><a class="nav-link" href="{{ route('riwayat-pendidikan.create') }}">Sekolah</a></li>
                <li class="{{set_active(['kursus-atau-pelatihan.create'])}}"><a class="nav-link" href="{{ route('kursus-atau-pelatihan.create') }}">Kursus/ Pelatihan</a></li>
                <li class="{{set_active(['pegawai-organisasi.create'])}}"><a class="nav-link" href="{{ route('pegawai-organisasi.create') }}">Organisasi</a></li>
            </ul>

            <li class="dropdown {{set_active(['pegawai-saudara-kandung.create','pegawai-mertua.create','pegawai-orangtua-kandung.create','pegawai-keterangan-keluarga.create'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Riwayat Keluarga</span></a>
            <ul class="dropdown-menu">
                <li class="{{set_active(['pegawai-keterangan-keluarga.create'])}}"><a class="nav-link" href="{{ route('pegawai-keterangan-keluarga.create') }}">Keluarga</a></li>
                <li class="{{set_active(['pegawai-orangtua-kandung.create'])}}"><a class="nav-link" href="{{ route('pegawai-orangtua-kandung.create') }}">Orang Tua Kandung</a></li>
                <li class="{{set_active(['pegawai-saudara-kandung.create'])}}"><a class="nav-link" href="{{ route('pegawai-saudara-kandung.create') }}">Saudara Kandung</a></li>                
                <li class="{{set_active(['pegawai-mertua.create'])}}"><a class="nav-link" href="{{ route('pegawai-mertua.create') }}">Mertua</a></li>
            </ul>

            <li class="dropdown {{set_active(['pegawai-pangkat-pns.create','pegawai-pangkat-cpns.create','pegawai-riwayat-kgb.create','pegawai-riwayat-pangkat.create','pegawai-diklat-penjenjangan.create','pegawai-keterangan-lain.create','pegawai-pengalaman-keluar-negeri.create','pegawai-penghargaan.create'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-folder-open"></i> <span>Kepegawaian</span></a>
            <ul class="dropdown-menu">
                <li class="{{set_active(['pegawai-pangkat-cpns.create'])}}"><a class="nav-link" href="{{ route('pegawai-pangkat-cpns.create') }}">Pangkat CPNS</a></li>
                <li class="{{set_active(['pegawai-pangkat-pns.create'])}}"><a class="nav-link" href="{{ route('pegawai-pangkat-pns.create') }}">Pangkat PNS</a></li>
                <li class="{{set_active(['pegawai-riwayat-pangkat.create'])}}"><a class="nav-link" href="{{ route('pegawai-riwayat-pangkat.create') }}">Kenaikan Pangkat</a></li>
                <li class="{{set_active(['pegawai-riwayat-kgb.create'])}}"><a class="nav-link" href="{{ route('pegawai-riwayat-kgb.create') }}">Kenaikan Gaji Berkala</a></li>
                <li class="{{set_active(['pegawai-diklat-penjenjangan.create'])}}"><a class="nav-link" href="{{ route('pegawai-diklat-penjenjangan.create') }}">Diklat Penjenjangan</a></li>
                <li class="{{set_active(['pegawai-penghargaan.create'])}}"><a class="nav-link" href="{{ route('pegawai-penghargaan.create') }}">Penghargaan</a></li>
                <li class="{{set_active(['pegawai-pengalaman-keluar-negeri.create'])}}"><a class="nav-link" href="{{ route('pegawai-pengalaman-keluar-negeri.create') }}">Pengalaman Keluar Negeri</a></li>
                <li class="{{set_active(['pegawai-keterangan-lain.create'])}}"><a class="nav-link" href="{{ route('pegawai-keterangan-lain.create') }}">Keterangan Lain</a></li>
            </ul>

            <li class="{{set_active(['pegawai-mutasi.index'])}}"><a class="nav-link" href="{{route('pegawai-mutasi.index')}}">
                <i class="fa fa-retweet"></i><span>Mutasi Pegawai</span></a>
            </li>

            <li class="{{set_active(['dokumen-pegawai.create'])}}"><a class="nav-link" href="{{route('dokumen-pegawai.create')}}">
                <i class="fa fa-book"></i><span>Dokumen Pegawai</span></a>
            </li>

        </ul>
    </aside>
    </div>