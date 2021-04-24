@extends('layouts.main')
@section('title','Detail Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
    <h1>Detail Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-9 col-lg-9">
                <div class="card  ">
                  <div class="card-body shadow">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Profil</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Suami/Istri</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row mt-2">
                            <div class="col-8 col-sm-4 col-lg-4">
                                <table>
                                    <tr>
                                        <td>FOTO</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-6">
                                <table>
                                    <tr>
                                        <td width="15">Nama Pegawai</td>
                                        <td width="1">:</td>
                                        <td width="20">{{ $pegawai->nama_pegawai }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIP Pegawai</td>
                                        <td width="1">:</td>
                                        <td width="20">{{ $pegawai->nip_pegawai }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td width="1">:</td>
                                        <td width="20">{{ $pegawai->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat,TGL</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Umur</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Golongan Darah</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Status Pernikahan</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>No.Tlp</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Status Kepegawaian</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                    <tr>
                                        <td>Unit Kerja</td>
                                        <td width="1">:</td>
                                        <td width="20"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                        Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui.
                      </div>
                      <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                        Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor.
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-2 col-md-3">
                <div class="card shadow">
                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link " id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                      </ul>
                </div>
              </div>
        </div>
    </div>
</section>
@endsection