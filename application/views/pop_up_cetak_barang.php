<div class="modal" id="myModalInput" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form <?php echo $aksi; ?> Data</h4>
            </div>

            <div class="modal-body">
                <form name="input_form" method="post" action="" onsubmit="return false">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" oninput="Check()" type="text" id="nama" name="nama"></input>
                            <p id="alert_nama" style="color:red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="harga1">Harga</label>
                        <div class="col-sm-3">
                            <input class="form-control" oninput="Check()" type="number" id="harga1" min="0" name="harga1"></input>
                            <p id="alert_umur" style="color:red;"></p>
                        </div>
                        <div id="gg1" style="display: none;">
                            <label class="col-sm-2 col-form-label" for="umur">sampai</label>
                            <div class="col-sm-5">
                                <input class="form-control" oninput="Check()" type="number" id="harga2" min="0" name="harga2"></input>
                                <p id="alert_umur" style="color:red;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="stok1">Stok</label>
                        <div class="col-sm-3">
                            <input class="form-control" oninput="Check()" type="number" id="stok1" min="0" name="stok1"></input>
                            <p id="alert_umur" style="color:red;"></p>
                        </div>
                        <div id="gg2" style="display: none;">
                            <label class="col-sm-2 col-form-label" for="stok2">sampai</label>
                            <div class="col-sm-5">
                                <input class="form-control" oninput="Check()" type="number" id="stok2" min="0" name="stok2"></input>
                                <p id="alert_umur" style="color:red;"></p>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group row-fluid justify-content-end flex" style="justify-content: end;">
                        <input id="submit" class="btn btn-danger" type="submit" value="CETAK PDF" onclick="KirimData('PDF')">
                        <input id="submit" class="btn btn-success" type="submit" value="CETAK EXCEL" onclick="KirimData('Excel')">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p id="demo"></p>
                <p id="success_notif" style="color:green;"></p>
                <p id="redirect_time"></p>
            </div>
        </div>
    </div>
</div>

<script>
    function Check() {
        var a = document.getElementById("nama")
        var b1 = document.getElementById("harga1")
        var b2 = document.getElementById("harga2")
        var gg1 = document.getElementById("gg1")
        var c1 = document.getElementById("stok1")
        var c2 = document.getElementById("stok2")
        var gg2 = document.getElementById("gg2")
        
        if (b1.value == "") {
            gg1.style.display = "none"
        } else {
            gg1.style.display = "flex"
            b2.setAttribute('min', b1.value)
        }

        if (b2.value != "") {
            b1.setAttribute('max', b2.value)
        }

        if (c1.value == "") {
            gg2.style.display = "none"
        } else {
            gg2.style.display = "flex"
            c2.setAttribute('min', c1.value)
        }

        if (c2.value != "") {
            c1.setAttribute('max', c2.value)
        }
    }

    function KirimData(file) {
        var nama = $('#nama').val();
        var harga1 = $('#harga1').val();
        var harga2 = $('#harga2').val();
        var stok1 = $('#stok1').val();
        var stok2 = $('#stok2').val();
        if (nama == '') {
            nama = 0
        }
        if (harga1 == '') {
            harga1 = 0
        }
        if (harga2 == '') {
            harga2 = 0
        }
        if (stok1 == '') {
            stok1 = 0
        }
        if (stok2 == '') {
            stok2 = 0
        }
        var data = {
            nama: nama,
            harga1: harga1,
            harga2: harga2,
            stok1: stok1,
            stok2: stok2
        }
        console.log(data)
        $.ajax({
            url: "<?php echo base_url(); ?>barang/Cetak" + file + "/" + nama + "/" + harga1 + "/" + harga2 + "/" + stok1 + "/" + stok2, // + tgl1 + "=" + tgl2 + "=" + nomor,
            type: "POST",
            data: data,
            success: function(rdata) {
                document.getElementById("success_notif").innerHTML = "Data Dicetak"
                setTimeout(PopSuccess(), 3000)
            }
        })

        function PopSuccess() {
            var frm = document.getElementsByName("input_form")[0]
            frm.reset()
            $('#myModalInput').modal('toggle')
            window.open("<?php echo base_url(); ?>barang/Cetak" + file + "/" + nama + "/" + harga1 + "/" + harga2 + "/" + stok1 + "/" + stok2 /* + tgl1 + "=" + tgl2 + "=" + nomor*/ , "_blank")
        }

        function Timing(t) {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>