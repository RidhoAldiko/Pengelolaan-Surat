<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table.static{
        position: relative;
        border: 1px solid black;
    }
    td {
        padding: 10px;
        text-align: left;
        font-size: 10px;
    }
    .bingkai{
        border-style: solid;
        border-color: black;
    }
    .isi{
        padding: 15px 15px 15px 15px;
    }
    .isi2{
        padding-left: 10px;
    }
    .verticalLine {
    border-left: thick solid black;
    border-width: 1px;
    padding: 5px 40px 15px 10px;
    }
    </style>
    <title>Cetak Surat Masuk</title>
</head>
<body>
    <div class="bingkai">
        <div class="isi">
            <p style="font-size: 16px;border-bottom-style:solid;border-bottom-width:1px;border-botom-color:black;" class="isi2"><strong>SURAT MASUK</strong></p>
        <p style="display: inline;">No.Urut: <b>{{$result->id_surat_masuk}}</b></p>
        <p style="display: inline;padding-right: 20px;padding-left:20px"></p>
        <p class="verticalLine"style="display: inline;padding-left:40px;">Tgl Masuk: {{date('d-m-Y',strtotime($result->tanggal_surat))}}</p>
        <p style="display: inline;padding-right: 20px;padding-left:20px"></p>
        <p class="verticalLine"style="display: inline"></b></p>

        <p style="border-bottom-style:solid;border-bottom-width:1px;border-botom-color:black;"></p>
        <p style="border-bottom-style:solid;border-bottom-width:1px;border-botom-color:black;">
        Isi Ringkas : {{$result->isi_ringkasan}}</p>
        <p style="border-bottom-style:solid;border-bottom-width:1px;border-botom-color:black;">Lampiran: </p>
    
        <p style="display: inline;">Dari:</p>
        <p style="display: inline;padding-right: 200px;padding-left:20px"></p>
        <p class="verticalLine"style="display: inline">Kepada:</p>

        <p style="border-bottom-style:solid;border-bottom-width:1px;border-botom-color:black;"></p>
        <p style="display: inline;">Tanggal: {{date('d-m-Y')}}</p>
        <p style="display: inline;padding-right: 200px;padding-left:20px"></p>
        <p class="verticalLine"style="display: inline">No.Surat: {{$result->nomor_surat}}</p>
        <p style="border-bottom-style:solid;border-bottom-width:1px;border-botom-color:black;"></p>
        <p style="border-bottom-style:solid;border-bottom-width:1px;border-botom-color:black;">
            Catatan : </p>
        <hr style=" border: 4px dashed black;">

            <p style="font-size: 16px" class="isi2"><strong>LEMBARAN DISPOSISI</strong></p>
            <table class="static" align="center" rules="all" style="width:98%;">
                <tr>
                    <td width="40%" style="border-right: 0px; border-left:0px">No.Urut: {{$result->id_surat_masuk}}</td>
                    <td style="border-right: 0px; border-left:0px">Tgl Diterima: {{date('d-m-Y',strtotime($result->tanggal_surat))}}</td>
                    <td style="border-left:0px"></td>
                    
                </tr>
                <tr>
                    <td style="border: 0px;">
                        Asal :
                    </td>
                    <td colspan="2" style="border-left: 0px;border-top: 0px; border-bottom:0px">
                       
                    </td>
                </tr>
                <tr>
                    <td style="border: 0px;">
                        Iri Ringkas :
                    </td>
                    <td colspan="2" style="border-left: 0px;border-top: 0px; border-bottom:0px">
                        {{$result->isi_ringkasan}}
                    </td>
                </tr>
                <tr>
                    <td style="border: 0px;">
                        Tanggal/Nomor :
                    </td>
                    <td colspan="2" style="border-left: 0px;border-top: 0px;">
                        {{date('d-m-Y',strtotime($result->tanggal_surat))}} / {{$result->nomor_surat}}
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 0px; border-left:0px">
                        Tanggal Penyelesaian
                    </td>
                    <td colspan="2" style="border-left:0px">
                        {{date('d-m-Y',strtotime($result->tanggal_disposisi))}}
                    </td>
                </tr>
                <tr>
                    <td> Instruksi / Informasi <br>
                        @foreach ($data as $result)
                            {{$result->instruksi}} <br>
                        @endforeach
                    </td>
                    <td colspan="3">Dilihat dan Disetujui Oleh <br>
                        @foreach ($data as $item)
                            @if ( $item->id_jabatan == 1) 
                                {{$loop->iteration}}. {{$item->nama_jabatan}}.
                            @elseif ( $item->id_jabatan == 2) 
                                {{$loop->iteration}}. {{$item->nama_jabatan}}.
                            @elseif ( $item->id_jabatan == 3) 
                                {{$loop->iteration}}. {{$item->nama_jabatan}}. {{$item->nama_staf_ahli}}
                            @elseif ( $item->id_jabatan == 4) 
                                {{$loop->iteration}}. {{$item->nama_jabatan}}. {{$item->nama_asisten}}
                            @elseif ( $item->id_jabatan == 5) 
                                {{$loop->iteration}}. {{$item->nama_jabatan}}. {{$item->nama_bagian}}
                            @elseif ( $item->id_jabatan == 6) 
                                {{$loop->iteration}}. {{$item->nama_jabatan}}. {{$item->nama_sub_bagian}}
                            @endif
                        <br>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom:0px"><center><u>Sesudah digunakan harap dikembalikan</u></center></td>
                </tr>
                <tr>
                    <td colspan="2" style="border-right:0px;border-top:0px">Kepada:</td>
                    <td style="border-left:0px ;border-top:0px">Tanggal:</td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>