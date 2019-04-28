<?php

$crud = new crud();
$generate = new ResultSet($crud->read2('pelanggan','max(idpelanggan) as maxKode'));
$data = $generate->toArray();
$kode = $data[0]['maxKode'];
$kode++;
 ?>