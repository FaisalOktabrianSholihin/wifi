{{-- <!DOCTYPE html>
<html>

<head>
    <title>Detail Pelanggan</title>
</head>

<body>
    <h1>Detail Pelanggan</h1>
    <p>No Pelanggan: {{ $customer->no_pelanggan }}</p>
    <p>Nama: {{ $customer->nama }}</p>


    <h2>Informasi Pemasangan</h2>
    <p>Status Lunas: {{ $pemasangan->status_lunas }}</p>
    <p>Bayar: {{ $pemasangan->bayar }}</p>
    <p>Diskon: {{ $pemasangan->diskon }}</p>
    <p>Biaya: {{ $pemasangan->biaya }}</p>

</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Kecil</title>

    <?php
    $style = '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <style>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        * {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            font-family: "consolas", sans-serif;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        p {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            display: block;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            margin: 3px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            font-size: 10pt;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        table td {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            font-size: 9pt;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        .text-center {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            text-align: center;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        .text-right {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            text-align: right;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @media print {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @page {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                margin: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                size: 75mm 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            html, body {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                width: 70mm;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            .btn-print {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                display: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </style>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ';
    ?>

    {!! $style !!}
</head>

<body onload="window.print()">
    <div class="header" style="margin-bottom: 15px; text-align: center;">
        <h2>WIFI</h2>
        <small>456 Jalan Sejahtera, Kota Ceria, Negara Bahagia, Kode Pos: 54321</small>
    </div>
    <br>
    <div>
        <p style="float: left;">No: {{ $ubahpaket->no_pelanggan }}</p>
        <p style="float: right">{{ date('j F Y') }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>{{ $ubahpaket->pelanggan->nama }}</p>
    <p class="text-center">===================================</p>


    <table width="100%" style="border: 0;">
        {{-- @foreach ($customer as $item) --}}
        <tr>
            <td colspan="3">Nama Paket</td>
        </tr>
        <tr>
            <td>{{ $ubahpaket->paket->paket }}</td>
            <td></td>
            <td class="text-right">Rp. {{ $ubahpaket->paket->iuran }}</td>
        </tr>
        <tr>
            <td>Instalasi</td>
            <td></td>
            <td class="text-right">Rp. {{ $ubahpaket->paket->instalasi }}</td>
        </tr>
        <tr>
            <td>Diskon:</td>
            <td></td>
            <td class="text-right">Rp. {{ $ubahpaket->diskon }}</td>
        </tr>
        {{-- @endforeach --}}
    </table>
    <p class="text-center">===================================</p>


    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Biaya:</td>
            <td class="text-right">Rp.
                {{ $total_biaya = $ubahpaket->paket->iuran + $ubahpaket->paket->instalasi - $ubahpaket->diskon }}
            </td>
        </tr>
        <tr>
            <td>Tunai:</td>
            <td class="text-right">Rp. {{ $ubahpaket->bayar }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td class="text-right">Rp. {{ $ubahpaket->bayar - $total_biaya }}</td>
        </tr>
        <tr>
            {{-- <td>Kembali:</td> --}}
            <td></td>
            <td class="text-right"><b>{{ $ubahpaket->status_lunas }}</b></td>
        </tr>
    </table>
    <p class="text-center">===================================</p>
    <br>
    <p class="text-center">-- TERIMA KASIH --</p>
    {{-- <p class="text-center">Harap Kembali jika tidak trauma ya bang</p> --}}

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight=" + ((height + 50) * 0.264583);
    </script>
</body>

</html>
