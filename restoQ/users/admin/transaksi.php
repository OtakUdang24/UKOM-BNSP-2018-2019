<?php 
if (!defined('ACCESS')) { die('System Cannot Running'); } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css">
    <link href="assets/datepicker/css/datepicker.css" rel="stylesheet">
    <link type="text/css" href="css/bootstrap-timepicker.min.css" />
 
    <title>Document</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-md navbar-light bg-white text-darksticky-top">
        <div class="container">
            <a class="navbar-brand" href="http://localhost:8080/restoQ/?page=Home">RestoQ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a href="?page=EntriMeja" class="dropdown-item active">Entri Meja</a>
                            <a href="?page=Kendaraan" class="dropdown-item">Kendaraan</a>
                            <a href="?page=GenerateLaporan" class="dropdown-item">Generate Laporan</a>
                            
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Somethin else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <section id="min" class="mt-3">
        <div class="container">
            <div class="row">
            <div class="col">
            <?php 
            if(isset($_SESSION['msg'])){?>
                <div class="alert alert-success" role="alert">
                    <?=$_SESSION['msg']?>
                </div>
                <?php
                unset($_SESSION['msg']);
            }?>
            </div>
            </div>
        </div>
    </section>
    <section id="dua" class="mt-3">
<div class="container">
        <div class="row">
            <div class="col">

                <table class="display" id="table_id">
                    <thead>
                        <tr>
                            <th>Kode Meja</th>
                            <th>ID Pelanggan</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    $crud = new crud();
                    $resultSet = new resultSet($crud->join("SELECT pesanan.jumlah,pesanan.id,pesanan.idpelanggan, pesanan.id_menu ,meja.no, barang.nama, barang.harga, users.nama as 'namaU', pesanan.jumlah FROM `pesanan`
                    INNER JOIN meja ON pesanan.no_meja = meja.no
                    INNER JOIN barang ON pesanan.id_menu = barang.kode
                    INNER JOIN users ON pesanan.id_user = users.id_user WHERE pesanan.status = '0' "));
        
                    foreach ($resultSet->toArray() as $key => $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['no']; ?></td>
                            <td><?php echo $row['idpelanggan']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['jumlah']; ?></td>
                            <td><?php echo $row['namaU']; ?></td>
                
                            <td>
                                <a class="btn btn-primary"
                                    href="action.php?deleteTransaksi=<?=$row['id']?>">Hapus</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#editModal<?php echo $row['id'];?>">Bayar</button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editModal<?php echo $row['id'];?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Meja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="action.php">
                                            <div class="form-group">
                                                <label for="nomor">Id Pesanan</label>
                                                <input type="text" readonly id="idPes" class="form-control" name="idPes"
                                                        value="<?php echo $row['id'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor">Total</label>
                                                <input type="text" readonly id="idPes" class="form-control" name="total"
                                                        value="<?php echo $row['jumlah']*$row['harga'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor">Bayar</label>
                                                <input type="text" id="idPes" class="form-control" name="bayar" Required value="">
                                            </div>
                                    </div>    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="insert_transaksi" class="btn btn-primary">Ubah</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<section>



<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.js"></script>
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
</body>
</html>