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
        <?php
        if ($this->session->userdata('admin')) {
            echo '  <div class="nav navbar-right center-block">
                        <a class="btn btn-primary" href="admin/logout">
                            Log Out
                        </a>
                    </div>';
        } ?>

    </nav>
    <div class="col-sm-3 col-md-2 navbar-fixed-top sidebar cust-menu" style="border-radius: 0px;top:51px; height:100%">
        <ul class="nav nav-sidebar">
            <li><button class="menu-buttn" onclick="Link('home')"><b>Home</b></button></li>
            <li><button class="menu-buttn" onclick="Link('orang')"><b>Orang</b></button></li>
            <li><button class="menu-buttn" onclick="Link('barang')"><b>Barang</b></button></li>
            <li><button class="menu-buttn" onclick="Link('log_book')"><b>Log Book</b></button></li>
            <li><button class="menu-buttn" onclick="Link('transaksi')"><b>Transaksi</b></button></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 text-left main" style="height:1000px;top:51px">
        <div id="page_view" class="container-fluid">
        </div>
    </div>
</body>

<script type="text/javascript">
    var link = window.location.href
    var base = "<?php echo base_url(); ?>"
    if (link == base) {
        link = base + "/home"
    }
    var data = {
        offset: '<?php (isset($offset)) ? print($offset) : print(0); ?>',
        limit: '<?php (isset($limit)) ? print($limit) : print(5); ?>'
    }
    $.ajax({
        url: (link + "/ViewPage").replaceAll('index/', ''),
        type: 'POST',
        //data: data,
        success: function(xdata) {
            $('#page_view').html(xdata);
        }
    })

    function RefreshTabel(offset, limit) {
        console.log(offset)
        $('.modal').modal('hide')
        $('body').removeClass('modal-open')
        $('.modal-backdrop').remove()
        data = {
            offset: offset,
            limit: limit
        }
        var element = document.getElementsByName('tableContent')
        for (let i = element.length; i > 0; i--) {
            element[i - 1].remove()
        }
        $.ajax({
            url: (link + "/ViewPage").replaceAll('index/', ''),
            type: 'POST',
            data: data,
            success: function(vdata) {
                $("#page_view").html(vdata);
            }
        })
    }

    function Link(x) {
        var link = "<?php echo base_url(); ?>" + x;
        window.location.href = link
    }
</script>

</html>