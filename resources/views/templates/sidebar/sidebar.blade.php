
@if (Auth::user()->level==0)
    @include('template.admin.sidebar')
@endif