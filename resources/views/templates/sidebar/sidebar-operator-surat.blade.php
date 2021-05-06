<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            
            <li class=active><a class="nav-link" href="{{route('operator-surat.index')}}">
                <i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            
            <li class="menu-header">Menu</li>
            <li class="dropdown {{set_active(['surat-masuk.index','surat-masuk.create','disposisi-surat-masuk.create'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-copy"></i> <span>Surat</span></a>
                <ul class="dropdown-menu">
                    <li class="{{set_active(['surat-masuk.index','surat-masuk.create','disposisi-surat-masuk.create'])}}"><a class="nav-link " href="{{route('surat-masuk.index')}}">Surat Masuk</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Surat Keluar</a></li>
                </ul>
            <li>

            <li class="dropdown {{set_active(['disposisi_surat_masuk.index','disposisi-surat-masuk.teruskan'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-copy"></i> <span>Disposisi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{set_active(['disposisi_surat_masuk.index','disposisi-surat-masuk.teruskan'])}}"><a class="nav-link " href="{{route('disposisi_surat_masuk.index')}}">Disposisi Surat masuk</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Disposisi Surat Keluar</a></li>
                </ul>
            <li>

                <li class="dropdown {{set_active(['disposisi_surat_masuk.index','disposisi-surat-masuk.teruskan'])}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-copy"></i> <span>Arsip</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{set_active(['disposisi_surat_masuk.index','disposisi-surat-masuk.teruskan'])}}"><a class="nav-link " href="{{route('disposisi_surat_masuk.index')}}">Arsip Surat masuk</a></li>
                        <li><a class="nav-link" href="layout-transparent.html">Arsip Surat Keluar</a></li>
                    </ul>
                <li>  
        </ul>
    </aside>
    </div>