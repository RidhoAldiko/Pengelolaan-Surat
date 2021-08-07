@extends('layouts.main')
@section('title','Dashboard')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card shadow card-statistic-1">
                <div class="card-header">
                    <h4>Disposisi Surat</h4>
                </div>
                <div class="card-body mt-1 mb-4">
                    {{$disposisi}}
                </div>
            </div>
        </div>
    
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card shadow card-statistic-1">
                <div class="card-header">
                    <h4>Approval Surat</h4>
                </div>
                <div class="card-body mt-1 mb-4">
                    {{$approval}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection