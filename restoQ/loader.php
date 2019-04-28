<?php
// hindari akses langsung ke file ini
if (!defined('ACCESS')) {
    die('System Cannot Running');
}

session_start();


if (!file_exists(dirname(__FILE__).'/classes/database.php')) {
    die('File database.php Tidak ada');
}

// menyisipkan file config
require dirname(__FILE__).'/classes/database.php';

if (!file_exists(dirname(__FILE__).'/classes/resultSet.php')) {
    die('File result.php Tidak ada');
}

// menyisipkan file config
require dirname(__FILE__).'/classes/resultSet.php';

if (!file_exists(dirname(__FILE__).'/classes/crud.php')) {
    die('File crud.php Tidak ada');
}

// menyisipkan file config
require dirname(__FILE__).'/classes/crud.php';


/**
 * Definisi direktori 
 */

// define('ABSPATH', dirname(__FILE__) . '/');
// definisi main direktori
define('ABSPATH', dirname(__FILE__) . '/');
define('USERS', ABSPATH . 'users/');
define('STD', ABSPATH . 'view_std/');

$login = (isset($_GET['login']) ? $_GET['login'] : false);

if(!isset($_SESSION['login'])){
    // Blm login
    if(isset($_GET['page'])){
        if($_GET['page'] == "register"){
            require USERS . "register.php"; 
        }elseif($_GET['page'] == "login"){
            require USERS . "login.php"; 
        }
    }else{
        require USERS . "welcome.php";
    }
}else{
    if(isset($_SESSION['level']) AND $_SESSION['level'] == "admin"){
        if(isset($_GET['page'])){
            if($_GET['page'] == "Home"){
                // echo "admin";
                require USERS . "admin/home.php"; 
            }elseif($_GET['page'] == "EntriMeja"){
                require USERS . "admin/entriMeja.php"; 
            }elseif($_GET['page'] == "EntriBarang"){
                require USERS . "admin/entriBarang.php"; 
            }elseif($_GET['page'] == "EntriPelanggan"){
                require USERS . "admin/entriPelanggan.php"; 
            }
        }elseif(isset($_GET['tgllapor'])){
            require USERS . "admin/cetak.php"; 
        }
    }elseif(isset($_SESSION['level']) AND $_SESSION['level'] == "waiter"){
        if(isset($_GET['page'])){
            if($_GET['page'] == "Home"){
                // echo "waiter";
                require USERS . "waiter/home.php"; 
            }elseif($_GET['page'] == "EntriBarang"){
                require USERS . "waiter/entriBarang.php"; 
            }elseif($_GET['page'] == "EntriPesanan"){
                require USERS . "waiter/entriPesanan.php"; 
            }elseif($_GET['page'] == "GenerateLaporan"){
                require USERS . "waiter/generateLaporan.php"; 
            }
        }elseif(isset($_GET['tgllapor'])){
            require USERS . "waiter/cetak.php"; 
        }
    }elseif(isset($_SESSION['level']) AND $_SESSION['level'] == "kasir"){
        if(isset($_GET['page'])){
            if($_GET['page'] == "Home"){
                // echo "kasir";
                require USERS . "kasir/home.php"; 
            }elseif($_GET['page'] == "Transaksi"){
                require USERS . "kasir/Transaksi.php"; 
            }elseif($_GET['page'] == "GenerateLaporan"){
                require USERS . "kasir/generateLaporan.php"; 
            }
        }elseif(isset($_GET['tgllapor'])){
            require USERS . "kasir/cetak.php"; 
        }
    }elseif(isset($_SESSION['level']) AND $_SESSION['level'] == "owner"){
        if(isset($_GET['page'])){
            if($_GET['page'] == "Home"){
                // echo "owner";
                require USERS . "owner/home.php"; 
            }elseif($_GET['page'] == "GenerateLaporan"){
                require USERS . "owner/generateLaporan.php"; 
            }
        }elseif(isset($_GET['tgllapor'])){
            require USERS . "owner/cetak.php"; 
        }
    }
}




?>