@extends('layouts.main')
@section('title','Unit Kerja')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Unit Kerja</h1>
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
    <div class="col-12 ">
        <div class="card shadow">
            <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Staf Ahli</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Asisten</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Bagian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="subbagian-tab" data-toggle="tab" href="#subbagian" role="tab" aria-controls="subbagian" aria-selected="false">Sub Bagian</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col">
                        <a href="{{ route('staf-ahli.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus"></i> Tambah Data Staf Ahli</a>
                    </div>
                    <div class="col table-responsive">
                        <table id="stafTable" class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Staf Ahli</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            @foreach ($staf_ahli as $staf)
                            @if ($staf->nama_staf_ahli != '-')
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$staf->nama_staf_ahli}}</td>
                                @if ($staf->status == 0)
                                    <td>Aktif</td>
                                @else
                                    <td>Tidak Aktif</td>
                                @endif
                                <td>
                                    <a href="{{ route('staf-ahli.edit',$staf->id_staf_ahli) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit fa-sm"></i> <span>Ubah</span>
                                    </a>
                                    {{-- <a href="#" class="btn btn-danger btn-sm getIdStafAhli" data-toggle="modal" data-target="#deleteStafAhli" data-id="{{$staf->id_staf_ahli}}"> 
                                        <i class="fas fa-trash fa-sm"> <span>Hapus</span></i>
                                    </a>  --}}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col">
                        <a href="{{route('asisten.create')}}" class="btn btn-primary my-3"><i class="fas fa-plus"></i> Tambah Data Asisten</a>
                    </div>
                    <div class="col table-responsive">
                        <table id="asistenTable" class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Asisten</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>                            
                            </thead>
                            <tbody>
                                @foreach ($asisten as $result)
                                @if ($result->nama_asisten != '-')
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$result->nama_asisten}}</td>
                                    @if ($result->status == 0)
                                        <td>Aktif</td>
                                    @else
                                        <td>Tidak Aktif</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('asisten.edit',$result->id_asisten) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit fa-sm"></i> <span>Ubah</span>
                                        </a>
                                        {{-- <a href="#" class="btn btn-danger btn-sm getIdAsisten" data-toggle="modal" data-target="#deleteAsisten" data-id="{{$result->id_asisten}}"> 
                                            <i class="fas fa-trash fa-sm"> <span>Hapus</span></i>
                                        </a>  --}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="col">
                        <a href="{{route('bagian.create')}}" class="btn btn-primary my-3"><i class="fas fa-plus"></i> Tambah Data Bagian</a>
                    </div>
                    <div class="col table-responsive">
                        <table id="bagianTable"  class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Asisten</th>
                                    <th scope="col">Bagian</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>                            
                            </thead>
                            <tbody>
                                @foreach ($bagian as $result)
                                @if ($result->nama_bagian != '-')
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$result->nama_asisten}}</td>
                                    <td>{{$result->nama_bagian}}</td>
                                    @if ($result->status == 0)
                                        <td>Aktif</td>
                                    @else
                                        <td>Tidak Aktif</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('bagian.edit',$result->id_bagian) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit fa-sm"></i> <span>Ubah</span>
                                        </a>
                                        {{-- <a href="#" class="btn btn-danger btn-sm getIdBagian " data-toggle="modal" data-target="#deleteBagian" data-id="{{$result->id_bagian}}"> 
                                            <i class="fas fa-trash fa-sm"> <span>Hapus</span></i>
                                        </a>  --}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="subbagian" role="tabpanel" aria-labelledby="subbagian-tab">
                    <div class="col">
                        <a href="{{route('sub-bagian.create')}}" class="btn btn-primary my-3"><i class="fas fa-plus"></i> Tambah Data Sub Bagian</a>
                    </div>
                    <div class="col">
                        <div class="col table-responsive">
                            <table id="subBagianTable"  class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Bagian</th>
                                        <th scope="col">Sub Bagian</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>                            
                                </thead>
                                <tbody>
                                    @foreach ($sub_bagian as $result)
                                    @if ($result->nama_sub_bagian != '-')
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$result->nama_bagian}}</td>
                                        <td>{{$result->nama_sub_bagian}}</td>
                                        @if ($result->status == 0)
                                            <td>Aktif</td>
                                        @else
                                            <td>Tidak Aktif</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('sub-bagian.edit',$result->id_sub_bagian) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit fa-sm"></i> <span>Ubah</span>
                                            </a>
                                            {{-- <a href="#" class="btn btn-danger btn-sm getIdSubBagian" data-toggle="modal" data-target="#deleteSubBagian" data-id="{{$result->id_sub_bagian}}"> 
                                                <i class="fas fa-trash fa-sm"> <span>Hapus</span></i>
                                            </a>  --}}
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

{{-- modal delete --}}
<div class="modal fade" id="deleteStafAhli" tabindex="-1" role="dialog" aria-labelledby="deleteStafAhliLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteStafAhliLabel">Ingin menghapus data ?</h4>
        </div>
        <div class="modal-body">
            <h5 class="h5 text-center alert-text">Tekan "hapus" untuk menghapus.</h5> 
            <div class="modal-footer d-flex justify-content-center">        
                <form action="" method="post"  class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form> </td>
                
            </div>
        </div>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade" id="deleteAsisten" tabindex="-1" role="dialog" aria-labelledby="deleteAsistenLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteAsistenLabel">Ingin menghapus data ?</h4>
        </div>
        <div class="modal-body">
            <h5 class="h5 text-center alert-text">Tekan "hapus" untuk menghapus.</h5> 
            <div class="modal-footer d-flex justify-content-center">        
                <form action="" method="post"  class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form> </td>
                
            </div>
        </div>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade" id="deleteBagian" tabindex="-1" role="dialog" aria-labelledby="deleteBagianLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteBagianLabel">Ingin menghapus data ?</h4>
        </div>
        <div class="modal-body">
            <h5 class="h5 text-center alert-text">Tekan "hapus" untuk menghapus.</h5> 
            <div class="modal-footer d-flex justify-content-center">        
                <form action="" method="post"  class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form> </td>
                
            </div>
        </div>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade" id="deleteSubBagian" tabindex="-1" role="dialog" aria-labelledby="deleteSubBagianLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteSubBagianLabel">Ingin menghapus data ?</h4>
        </div>
        <div class="modal-body">
            <h5 class="h5 text-center alert-text">Tekan "hapus" untuk menghapus.</h5> 
            <div class="modal-footer d-flex justify-content-center">        
                <form action="" method="post"  class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form> </td>
                
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
<script>
    //delete data staf ahli
    $('.getIdStafAhli').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-unit-kerja/staf-ahli'+'/'+_id);
    })

    //delete data asisten
    $('.getIdAsisten').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-unit-kerja/asisten'+'/'+_id);
    })

    //delete data bagian
    $('.getIdBagian').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-unit-kerja/bagian'+'/'+_id);
    })

    $('.getIdSubBagian').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-unit-kerja/sub-bagian'+'/'+_id);
    })

    $(document).ready(function() {
        $('#stafTable').DataTable();
        $('#asistenTable').DataTable();
        $('#bagianTable').DataTable();
        $('#subBagianTable').DataTable();

    } );
    

</script>
@endpush
