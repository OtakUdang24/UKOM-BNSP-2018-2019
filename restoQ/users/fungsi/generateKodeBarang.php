<?php

$crud = new crud();
$generate = new ResultSet($crud->read2('barang','max(kode) as maxKode'));
$data = $generate->toArray();
$kode = $data[0]['maxKode'];
$noUrut = (int) $kode;
$noUrut++;
$char = "";
$kode = sprintf("%04s", $noUrut);
 ?>