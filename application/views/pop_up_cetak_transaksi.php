<body>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content" style="padding: 20px;padding-bottom:10px">
            <span class="close flex" style="border-radius: 5px;opacity: 0.8;color:white;background-color:rgb(255, 0, 0, 1);height:40px;width:40px">
                &times;
            </span>
            <h1 style="color:blue">
                Form <?php echo $aksi; ?> Data
            </h1>
            <form name="input_form" method="post" action="" onsubmit="return false">
                <input type="hidden" id="id" name="id" value="<?php if (isset($row->id_item)) echo $row->id_item; ?>"></input>
                <div class="row-fluid">
                    <label for="tgl1">Tanggal:</label>
                    <input oninput="Check()" type="date" id="tgl1" name="tgl1" value=""></input>
                    <p id="alert_nama" style="color:red;"></p>
                </div>
                <div id="gg" style="display: none;" class="row-fluid">
                    <label for="tgl2">sampai&#160;</label>
                    <input oninput="Check()" type="date" id="tgl2" name="tgl2" value=""></input>
                    <p id="alert_nama" style="color:red;"></p>
                </div><br>
                <div class="row-fluid">
                    <label for="harga">Nomor Transaksi:</label>
                    <input oninput="Check()" type="text" id="nomor" min="0" name="nomor" value=""></input>
                    <p id="alert_harga" style="color:red;"></p>
                </div>

                <div class="row-fluid justify-content-end flex" style="justify-content: end;">
                    <input id="submit" class="btn btn-success" type="submit" value="CETAK SEMUA DATA" onclick="Validasi()">
                </div>
            </form>
        </div>
        <p id="demo"></p>
        <p id="success_notif" style="color:green;"></p>
        <p id="redirect_time"></p>
    </div>
</body>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function Check() {
        const d = document.getElementById("tgl1").value
        const e = document.getElementById("nomor").value
        var f = document.getElementById("gg")
        var g = document.getElementById("tgl2")
        let filled = d + e
        console.log("update" + d)
        if (d == "") {
            f.style.display = "none"
        } else {
            f.style.display = "flex"
            g.setAttribute('min', d)
        }

        if (filled == "") {
            document.getElementById("submit").value = "CETAK SEMUA DATA"
        } else {
            document.getElementById("submit").value = "CETAK DATA PILIHAN"
        }
    }

    function Validasi() {
        KirimData()
    }

    function KirimData() {
        var tgl1 = $('#tgl1').val();
        var tgl2 = $('#tgl2').val();
        var nomor = parseInt($('#nomor').val());
        var data = {
            tgl1: tgl1,
            tgl2: tgl2,
            nomor: nomor,
        }
        console.log(data)
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/CetakPDF",// + tgl1 + "=" + tgl2 + "=" + nomor,
            type: "POST",
            data: data,
            success: function() {
                document.getElementById("success_notif").innerHTML = "Data Terkirim"
                setTimeout(PopSuccess(), 3000)
            }
        })

        function PopSuccess() {
            var frm = document.getElementsByName("input_form")[0]
            frm.reset()
            modal.style.display = "none";
            window.open("<?php echo base_url(); ?>transaksi/CetakPDF"/* + tgl1 + "=" + tgl2 + "=" + nomor*/, "_blank")
        }

        function Timing(t) {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>