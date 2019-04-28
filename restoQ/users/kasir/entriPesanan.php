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
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
            html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }
    </style>
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
    <section id="nol" class="mt-3">
    <div class="container">
        <div class="row">
            
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">Tambah Pesanan</div>
                    <div class="card-body">
                        <form method="POST" action="action.php">
                            <div class="form-group">
                                                
                                                <label for="inputState">Meja</label>
                                                <select id="inputState" required name="kode_meja" class="form-control">
                                                    <option>Kode</option>
                                                    <?php 
                                                    $crud = new crud();
                                                    $where = [
                                                        'status' => 0
                                                    ];
                                                    $resultSet = new resultSet($crud->read("meja", $where));
                                                    $data = $resultSet->toArray();
                                                    foreach($data as $key => $val){
                                                        ?>
                                                        <option value="<?=$val['no']?>"><?=$val['no']?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label for="inputState">Pelanggan</label>
                                                <select id="inputState" required name="idpel" class="form-control">
                                                    <option>ID</option>
                                                    <?php 
                                                    $crud = new crud();
                                
                                                    $resultSet = new resultSet($crud->read("pelanggan"));
                                                    $data = $resultSet->toArray();
                                                    foreach($data as $key => $val){?>
                                         
                                                        <option value="<?=$val['idpelanggan']?>"><?=$val['idpelanggan']?></option>
                                                        <?php
                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
                                             
                            <div class="form-group">
                                                
                                                <label for="inputState">Menu</label>
                                                <select id="inputState" required name="menu" class="form-control">
                                                    <option>Menu</option>
                                                    <?php 
                                                    $crud = new crud();
                                
                                                    $resultSet = new resultSet($crud->read("barang"));
                                                    $data = $resultSet->toArray();
                                                    foreach($data as $key => $val){?>
                                         
                                                        <option value="<?=$val['kode']?>"><?=$val['nama']?></option>
                                                        <?php
                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
                            <div class="form-group">
                                <label for="inputPassword4">Jumlah</label>
                                <input type="text" required name="jumlah" value="" class="form-control<?php echo (isset($_SESSION['stok_msg']) ? ' is-invalid' : '')?>" id="inputPassword4"
                                    placeholder="Jumlah">
                                    <?php 
                                            if(isset($_SESSION['stok_msg'])){
                                            ?>
                                            <small id="usernameHelp" class="text-danger">
                                               <?=$_SESSION['stok_msg']?>
                                            </small>  
                                          
                                    <?php 
                                    } 
                                    unset($_SESSION['stok_msg']); ?>
                            </div>
                            <button type="submit" name="tambah_pesanan" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
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
                    $resultSet = new resultSet($crud->join("SELECT pesanan.id,pesanan.idpelanggan, pesanan.id_menu ,meja.no, barang.nama, users.nama as 'namaU', pesanan.jumlah FROM `pesanan`
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
                                    href="action.php?deletePesanan=<?=$row['id']?>">Hapus</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#editModal<?php echo $row['id'];?>">Edit</button>
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
                                            
                                                <label for="inputState">Meja</label>
                                                <input type="hidden" name="id" value="<?=$row['id']?>" id="">
                                                <select id="inputState" required name="kode_meja" class="form-control">
                                                    <option>Kode</option>
                                                    <?php 
                                                    $crud = new crud();
                                                    // $where = [
                                                    //     'status' => 0
                                                    // ];
                                                    $resultSet = new resultSet($crud->read("meja"));
                                                    $data = $resultSet->toArray();
                                                    foreach($data as $key => $val){
                                                        ?>
                                                        <option
                                                        <?php echo ($row['no'] === $val['no']) ? 'selected' : ''; ?>
                                                        value="<?=$val['no']?>"><?=$val['no']?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                            
                                                <label for="inputState">Menu</label>
                                                <input type="hidden" name="id" value="<?=$row['id']?>" id="">
                                                <select id="inputState" required name="id_menu" class="form-control">
                                                    <option>Nama</option>
                                                    <?php 
                                                    $crud = new crud();
                
                                                    $resultSet = new resultSet($crud->read("barang"));
                                                    $data = $resultSet->toArray();
                                                    foreach($data as $key => $val){
                                                        
                                                        ?>
                                                        <option
                                                        <?php echo ($row['id_menu'] === $val['kode']) ? 'selected' : ''; ?>
                                                        value="<?=$val['kode']?>"><?=$val['nama']?></option>
                                                        <?php
                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
            
                                        <div class="form-group">
                                            <label for="nomor">Jumlah</label>
                                            <input type="text" id="nomor" class="form-control" name="jumlah"
                                                    value="<?php echo $row['jumlah'];?>">
                                        </div>

                                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="updatePesanan" class="btn btn-primary">Ubah</button>
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