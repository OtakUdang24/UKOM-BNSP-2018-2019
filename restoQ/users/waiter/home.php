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
        /* .full-height {
        height: 100vh;
    } */

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
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
                            <a href="?page=EntriBarang" class="dropdown-item">Entri Barang</a>
                            <a href="?page=EntriPesanan" class="dropdown-item">Entri Pesanan</a>
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
    <div class="flex-center position-ref full-height mt-5">
            <div class="content">
                <div class="title m-b-md">
                    Selamat Datang Di <?=$_SESSION['level']; ?>
                </div>
            </div>
        </div>



<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.js"></script>
</body>
</html>