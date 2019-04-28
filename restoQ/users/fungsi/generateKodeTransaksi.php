<?php

$crud = new crud();
$generate = new ResultSet($crud->read2('transaksisewa','max(no_transaksi) as maxKode'));
$data = $generate->toArray();
$kode = $data[0]['maxKode'];
$noUrut = (int) substr($kode, 4, 4);
$noUrut++;
$char = "TRA-";
$kode = $char . sprintf("%04s", $noUrut);
 ?>