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
            
            <li class="menu-header">Menu Surat</li>
            <li class="dropdown {{set_active([
                'surat-masuk.index',
                'surat-masuk.create',
                'disposisi-surat-masuk.create',
                'disposisi_surat_masuk.index',
                'disposisi-surat-masuk.teruskan',
                'arsip-surat-masuk.index'
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-copy"></i> <span>Surat Masuk</span></a>
                <ul class="dropdown-menu">
                    <li class="{{set_active(['surat-masuk.index','surat-masuk.create','disposisi-surat-masuk.create'])}}">
                        <a class="nav-link " href="{{route('surat-masuk.index')}}">Surat</a>
                    </li>
                    <li class="{{set_active(['disposisi_surat_masuk.index','disposisi-surat-masuk.teruskan'])}}">
                        <a class="nav-link " href="{{route('disposisi_surat_masuk.index')}}">Disposisi Surat</a>
                    </li>
                    <li class="{{set_active(['arsip-surat-masuk.index'])}}">
                        <a class="nav-link " href="{{route('arsip-surat-masuk.index')}}">Arsip Surat</a>
                    </li>
                </ul>
            <li>
        </ul>
    </aside>
    </div>