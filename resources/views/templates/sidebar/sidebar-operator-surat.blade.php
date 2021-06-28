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
                'surat-masuk.show',
                'surat-masuk.edit',
                'disposisi-surat-masuk.create',
                'disposisi-surat-masuk.index',
                'disposisi-surat-masuk.show',
                'disposisi-surat-masuk.edit',
                'disposisi-surat-masuk.forward',
                'arsip-surat-masuk.index'
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-copy"></i> <span>Surat Masuk</span></a>
                <ul class="dropdown-menu">
                    <li class="{{set_active(['surat-masuk.index','surat-masuk.create','surat-masuk.show','surat-masuk.edit','disposisi-surat-masuk.create'])}}">
                        <a class="nav-link " href="{{route('surat-masuk.index')}}">Tabel Surat</a>
                    </li>
                    <li class="{{set_active(['disposisi-surat-masuk.index','disposisi-surat-masuk.show','disposisi_surat_masuk.edit','disposisi-surat-masuk.forward'])}}">
                        <a class="nav-link " href="{{route('disposisi-surat-masuk.index')}}">Disposisi Surat</a>
                    </li>
                    <li class="{{set_active(['arsip-surat-masuk.index'])}}">
                        <a class="nav-link " href="{{route('arsip-surat-masuk.index')}}">Arsip Surat</a>
                    </li>
                </ul>
            <li>
            
                <li class="dropdown {{set_active([
                    'surat-keluar.index',
                    'surat-keluar.create',
                    'surat-keluar.show',
                    'surat-keluar.edit',
                    'effort-surat.index',
                    'effort-surat.create',
                    'effort-surat.show',
                    'effort-surat.edit',
                    'effort-surat.forward',
                    'arsip-surat-keluar.index'
                ])}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-copy"></i> <span>Surat Keluar</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{set_active([
                            'surat-keluar.index',
                            'surat-keluar.create',
                            'surat-keluar.show',
                            'surat-keluar.edit'
                        ])}}">
                            <a class="nav-link " href="{{route('surat-keluar.index')}}">Tabel Surat</a>
                        </li>
                        <li class="{{set_active([
                            'effort-surat.index',
                            'effort-surat.create',
                            'effort-surat.show',
                            'effort-surat.edit',
                            'effort-surat.forward',
                        ])}}">
                            <a class="nav-link " href="{{route('effort-surat.index')}}">Approval Surat</a>
                        </li>
                        <li class="{{set_active(['arsip-surat-keluar.index'])}}">
                            <a class="nav-link " href="{{route('arsip-surat-keluar.index')}}">Arsip Surat</a>
                        </li>
                    </ul>
                <li>
        </ul>
    </aside>
    </div>