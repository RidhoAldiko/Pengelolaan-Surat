@if (Auth::user()->role==0)
    @include('templates.sidebar.sidebar-admin')
@endif
@if (Auth::user()->role==1)
    @include('templates.sidebar.sidebar-operator-surat')
@endif
@if (Auth::user()->role==2)
    @include('templates.sidebar.sidebar-operator-kepegawaian')
@endif