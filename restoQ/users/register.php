<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Resto Q</title>

    <!-- Style -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css">
    <link href="assets/datepicker/css/datepicker.css" rel="stylesheet">
    <link type="text/css" href="css/bootstrap-timepicker.min.css" />
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


</head>

<body class="bg-light">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white text-darksticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="?page=login" class="nav-link" tabindex="-1" aria-disabled="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=register" class="nav-link" tabindex="-1" aria-disabled="true">Register</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>

                        <div class="card-body">
                            <form method="POST" action="action.php">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control"
                                            name="name" value="<?php echo (isset($_SESSION['old_nama']) ? $_SESSION['old_nama'] : '')?>" required autofocus>
                                            <?php unset($_SESSION['old_nama']) ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text"
                                            name="username" class="form-control<?php echo (isset($_SESSION['msg_username']) ? ' is-invalid' : '')?>" value="<?php echo (isset($_SESSION['old_username']) ? $_SESSION['old_username'] : '')?>" required>
                                            <?php 
                                            if(isset($_SESSION['msg_username'])){
                                            ?>
                                            <small id="usernameHelp" class="text-danger">
                                               <?=$_SESSION['msg_username']?>
                                            </small>  
                                            <?php 
                                            unset($_SESSION['msg_username']);
                                    
                                        }unset($_SESSION['old_username']); ?>
                                    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control<?php echo (isset($_SESSION['msg_passc']) ? ' is-invalid' : '')?><?php echo (isset($_SESSION['msg_passc']) ? ' is-invalid' : '')?>"
                                            name="password" value="<?php echo (isset($_SESSION['old_password']) ? $_SESSION['old_password'] : '')?>" required>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                        Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control<?php echo (isset($_SESSION['msg_passc']) ? ' is-invalid' : '')?><?php echo (isset($_SESSION['msg_passc']) ? ' is-invalid' : '')?>"
                                            name="password_confirmation" required>
                                            <?php 
                                            if(isset($_SESSION['msg_passc'])){
                                            ?>
                                            <small id="usernameHelp" class="text-danger">
                                               <?=$_SESSION['msg_passc']?>
                                            </small>  
                                            <?php 
                                        } ?>
                                            <?php 
                                            unset($_SESSION['old_password']);
                                            unset($_SESSION['msg_passc']);
                                            ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>

                                    <div class="col-md-6">
                                        <select name="level" id="" class="form-control" required>
                                            <option value=""></option>
                                            <h1><?php echo $_SESSION['old_level'] ?></h1>
                                            <?php 
                                                
                                                if(isset($_SESSION['old_level'])){
                                                    if($_SESSION['old_level'] == 'admin'){     
                                                        ?>
                                                        <option selected="selected" value="admin">Admin</option>
                                                        <option value="waiter">Waiter</option>
                                                        <option value="kasir">Kasir</option>
                                                        <option value="owner">Owner</option>
                                                        <?php
                                                    }elseif($_SESSION['old_level'] == 'waiter'){     
                                                        ?>
                                                        <option value="admin">Admin</option>
                                                        <option selected="selected" value="waiter">Waiter</option>
                                                        <option value="kasir">Kasir</option>
                                                        <option value="owner">Owner</option>
                                                        <?php
                                                    }if($_SESSION['old_level'] == 'kasir'){     
                                                        ?>
                                                        <option value="admin">Admin</option>
                                                        <option value="waiter">Waiter</option>
                                                        <option selected="selected" value="kasir">Kasir</option>
                                                        <option value="owner">Owner</option>
                                                        <?php
                                                    }if($_SESSION['old_level'] == 'owner'){     
                                                        ?>
                                                        <option value="admin">Admin</option>
                                                        <option value="waiter">Waiter</option>
                                                        <option value="kasir">Kasir</option>
                                                        <option selected="selected" value="owner">Owner</option>
                                                        <?php
                                                    };
                                                }else{
                                                    ?>
                                                    <option value="admin">Admin</option>
                                                    <option value="waiter">Waiter</option>
                                                    <option value="kasir">Kasir</option>
                                                    <option value="owner">Owner</option>
                                                    <?php
                                                }
                                            ?>
                                            <?php unset($_SESSION['old_level']) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" name="register" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.js"></script>
<script type="text/javascript" src="assets/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-timepicker.min.js"></script>
<!-- <script src="assets/Validator/validator.js"></script> -->
<!-- <script>
  $.validate({
    lang: 'es'
  });
</script> -->

</body>

</html>