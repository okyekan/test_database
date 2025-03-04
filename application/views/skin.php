<head>
    <script src="<?php echo base_url() . 'assets/JQuery/jquery.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/CSS/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/CSS/app.css"); ?>" />
    <!-- <div class="row-fluid justify-content-end" style="padding-left:20px;background-color:rgb(174, 71, 98);color:rgb(255, 255, 255)">
        <h1>Hello</h1> -->
    </div>
</head>

<div style="background-color:rgb(222, 239, 238);">
    <div class="row-fluid">
        <div class="span2 cust-menu" style="height: 100%">
            <div class="row-fluid cust-menu"><button class="menu-buttn" onclick="Link('home')"><b>Home</b></button></div>
            <div class="row-fluid cust-menu"><button class="menu-buttn" onclick="Link('orang')"><b>Orang</b></button></div>
            <div class="row-fluid cust-menu"><button class="menu-buttn" onclick="Link('barang')"><b>Barang</b></button></div>
            <div class="row-fluid cust-menu"><button class="menu-buttn" onclick="Link('log_book')"><b>Log Book</b></button></div>
            <div class="row-fluid cust-menu"><button class="menu-buttn" onclick="Link('transaksi')"><b>Transaksi</b></button></div>
        </div>
        <div id="page_view" class="span10">
        </div>
    </div>
</div>
<script type="text/javascript">
    var link = window.location.href
    var base = "<?php echo base_url(); ?>"
    if (link == base) {
        link = base + "/home"
    }
    $.ajax({
        url: link + "/ViewPage",
        type: 'POST',
        success: function(xdata) {
            $('#page_view').html(xdata);
        }
    })

    function Link(x) {
        var link = "<?php echo base_url(); ?>" + x;
        window.location.href = link
    }
</script>
<div id="pop_up_form">
</div>