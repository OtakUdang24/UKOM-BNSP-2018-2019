<?php

$crud = new crud();
$generate = new ResultSet($crud->read2('meja','max(no) as maxKode'));
$data = $generate->toArray();
$kode = $data[0]['maxKode'];
$noUrut = (int) substr($kode, 5, 4);
$noUrut++;
$char = "MEJA-";
$kode = $char . sprintf("%04s", $noUrut);
 ?>