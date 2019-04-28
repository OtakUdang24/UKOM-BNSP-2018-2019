<?php

$crud = new crud();
$generate = new ResultSet($crud->read2('sopir','max(id_supir) as maxKode'));
$data = $generate->toArray();
$kode = $data[0]['maxKode'];
$noUrut = (int) substr($kode, 4, 4);
$noUrut++;
$char = "SUP-";
$kode = $char . sprintf("%04s", $noUrut);
 ?>