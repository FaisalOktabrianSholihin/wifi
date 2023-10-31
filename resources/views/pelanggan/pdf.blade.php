<!DOCTYPE html>
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

</html>
