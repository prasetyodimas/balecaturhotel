<?php session_start();
    include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Balecatur Hotel - Admin Panel</title>
    <link rel="shorcut icon" href="<?php echo "$site";?>frontend/icon/favicon.ico.png">
    <!-- Bootstrap Core CSS -->
    <link href="frontend/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="frontend/css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="frontend/css/sb-admin-2.css" rel="stylesheet">
    <link href="frontend/css/sb-admin-front.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 logo-title">
                <img src="<?php echo "$site";?>/frontend/logo/resize-logo balecatur.png">
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center;">Admin Panel</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="auth/proses-login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" autocomplete="off" name="username" type="username" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" autocomplete="off" name="password" type="password" required>
                                </div>
                                <div class="form-group">
                                    <select name="level_akses" class="form-control" autofocus required="">
                                        <option value="">Level Akses</option>
                                        <option value="1">Administrator</option>
                                        <option value="4">Room Boy</option>
                                        <option value="2">Receptionist</option>
                                        <option value="3">Pimpinan</option>
                                    </select>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Login" class="btn btn-lg btn-success btn-block">
                                <!-- <a href="adminpanel.php" class="btn btn-lg btn-success btn-block">Login</a> -->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="frontend/js/jquery.min.js"></script>
    <script src="frontend/js/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").validate({
                messages: {
                    username: "Kolom username tidak boleh kosong!",
                    password: "Kolom password tidak boleh kosong!",
                    level_akses :"Kolom level akses tidak boleh kosong!"
                }
            });
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="frontend/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="frontend/js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="frontend/js/sb-admin-2.js"></script>
</body>
</html>
