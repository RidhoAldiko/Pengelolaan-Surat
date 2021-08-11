@extends('layouts.main')
@section('title','Approval Surat')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Histori Approval</h1>
    </div>
    @if (session('status'))
    <div class="alert shadow alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Histori Data Approval</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="historiApproval" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Tgl Surat</th>
                                <th scope="col">Tgl Approval</th>
                                <th scope="col">status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('custom-js')
<script>
    $(function() {
        $('#historiApproval').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('arsip-approval.serverside')}}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nomor_surat',
                    name: 'nomor_surat'
                },
                {
                    data: 'tanggal_surat',
                    name: 'tanggal_surat'
                },
                {
                    data: 'tanggal_effort',
                    name: 'tanggal_effort'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },

                ],
            });
    } );
    </script>
@endpush
