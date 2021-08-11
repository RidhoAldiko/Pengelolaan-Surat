<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            UMSETKPR
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            KPR
        </div>
        <ul class="sidebar-menu">
            
            <li class=active><a class="nav-link" href="{{route('user-disposisi.index')}}">
                <i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            
            <li class="menu-header">Menu</li>
            
            <li class=""><a class="nav-link" href="{{route('data-disposisi.index')}}">
                <i class="fas fa-copy"></i><span>Tugas disposisi</span></a>
            </li>

            <li class=""><a class="nav-link" href="{{route('data-effort.index')}}">
                <i class="fas fa-copy"></i><span>Tugas Approval</span></a>
            </li>

            <li class="{{set_active(['arsip-disposisi.index',])}}"><a class="nav-link" href="{{route('arsip-disposisi.index')}}">
                <i class="fa fa-history" aria-hidden="true"></i><span>Histori Disposisi</span></a>
            </li>
            
            <li class="{{set_active(['arsip-approval.index',])}}"><a class="nav-link" href="{{route('arsip-approval.index')}}">
                <i class="fa fa-history" aria-hidden="true"></i><span>Histori Approval</span></a>
            </li>
                
        </ul>
    </aside>
    </div>