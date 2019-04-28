<?php
require 'vendor/autoload.php';
$tgl = $_GET['tgllapor'];
$crud = new crud();
$resultSet = new resultSet($crud->join("SELECT pesanan.no_meja,transaksi.id_pesanan,barang.nama,barang.harga,pesanan.jumlah,transaksi.total,transaksi.bayar,transaksi.createdAt FROM `transaksi` INNER JOIN pesanan ON transaksi.id_pesanan = pesanan.id INNER JOIN barang ON pesanan.id_menu = barang.kode  WHERE transaksi.createdAt = '".$tgl."'"));
$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Laporan Transaksi</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<style>
        html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: "Nunito", sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
}
</style>
</head>
<body>

<center><h1>Laporan Transaksi</h1></center>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            
            <th>No Meja</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Created At</th>
        </tr>';

        $i = 1;
        foreach ($resultSet->toArray() as $key => $value){
        $html .= '<tr>
            <td>'.$value['no_meja'].'</td>
            <td>'.$value['nama'].'</td>
            <td>'.$value['harga'].'</td>
            <td>'.$value['jumlah'].'</td>
            <td>'.$value['total'].'</td>
            <td>'.$value['bayar'].'</td>
            <td>'.$value['createdAt'].'</td>
            </tr>';
          }
$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('laporan-transaksi.pdf',\Mpdf\Output\Destination::INLINE);
?>
