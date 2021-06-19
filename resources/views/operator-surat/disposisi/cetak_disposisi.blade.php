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
    </style>
    <title>Cetak Disposisi</title>
</head>
<body>
    <center>
        <p style="font-size: 14px"><strong><u>LEMBARAN DISPOSISI</u></strong></p>
        <table class="static" align="center" rules="all" style="width:98%;">
            <tr>
                <td width="70%"><p>INDEKS:</p></td>
                <td><p>TANGGAL PENYELESAIAN</p></td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>PERIHAL:</p> <br>
                    <p style="display: inline ">TGL/N :</p> 
                    <p style="display: inline;padding-left:65%">Nomor:</p><br>
                    <p>AWAL:</p>
                </td>
            </tr>
            <tr>
                <td>INSTRUKSI/INFORMASIx)</td>
                <td>DITERUSKAN KEPADA <br>
                    @for ($i = 1; $i <= 5; $i++)
                     {{ $i }}. <br>
                    @endfor
                </td>
            </tr>
            <tr>
                <td colspan="2">x) 1.Kepada bawahan "instruksi" atau "informasi" <br>
                    2.Kepada atasan "informasi" Coret "Instruksi"
                </td>
            </tr>
        </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>