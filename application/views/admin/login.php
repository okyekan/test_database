<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="<?php echo base_url() . 'assets/JQuery/jquery.js'; ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/CSS/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/CSS/app.css"); ?>" />
    <style>
        /* .affix {
            top: 0;
            width: 100%;
            z-index: 9999 !important;
        }

        .affix+.container-fluid {
            padding-top: 70px;
        } */
        body {
            padding-right: 0 !important
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
        </ul>
    </nav>
    <div class="login col-md-offset-4 col-md-4 mx-auto text-center" style="top:51px">
        <h1>Login</h1>
        <form method="post" action="<?php echo base_url() . 'admin/login/verify' ?>">
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Login" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>