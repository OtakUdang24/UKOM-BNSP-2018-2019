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
    <nav class="navbar navbar-expand-lg navbar-light bg-white text-dark sticky-top">
      <div class="container">
        <a class="navbar-brand" href="http://localhost:8080/restoQ/">RestoQ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="?page=login" class="nav-link" tabindex="-1" aria-disabled="true">Login</a>
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
              <div class="card-header bg-light text-dark">Login</div>

              <div class="card-body">
                <form method="POST" action="action.php">
                  <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                    <div class="col-md-6">
                      <input id="username" type="text" class="form-control" name="username" value="" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                  </div>
                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" name="login" class="btn btn-primary">
                        Login
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

</body>

</html>
