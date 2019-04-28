<?php

$crud = new crud();
$generate = new ResultSet($crud->read2('service','max(kode) as maxKode'));
$data = $generate->toArray();
$kode = $data[0]['maxKode'];
$noUrut = (int) substr($kode, 4, 4);
$noUrut++;
$char = "SER-";
$kode = $char . sprintf("%04s", $noUrut);
 ?>