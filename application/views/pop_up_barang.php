<div class="modal" id="myModalInput" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form <?php echo $aksi; ?> Data</h4>
            </div>

            <div class="modal-body">
                <form name="input_form" method="post" action="" onsubmit="return false">
                    <input type="hidden" id="id" name="id" value="<?php if (isset($row->id_item)) echo $row->id_item; ?>"></input>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="nama">Nama Barang</label>
                        <div class="col-sm-10">
                            <input class="form-control" required type="text" id="nama" name="nama" value="<?php if (isset($row->nama_barang)) echo $row->nama_barang; ?>"></input>
                            <p id="alert_nama" style="color:red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="harga">Harga</label>
                        <div class="col-sm-10">
                            <input class="form-control" required type="text" id="harga" min="0" name="harga" value="<?php if (isset($row->harga)) echo $row->harga; ?>"></input>
                            <p id="alert_harga" style="color:red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="stok">Stok</label>
                        <div class="col-sm-10">
                            <input class="form-control" required type="text" id="stok" min="0" name="stok" value="<?php if (isset($row->stok)) echo $row->stok; ?>"></input>
                            <p id="alert_stok" style="color:red;"></p>
                        </div>
                    </div>

                    <div class="row-fluid justify-content-end flex" style="justify-content: end;">
                        <input class="btn btn-success" type="submit" value="SUBMIT" onclick="Validasi()">
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

    function Validasi() {
        if (VNama() & VHarga() & VStok()) {
            ("<?php echo $aksi ?>" == "Tambah") ? KirimData("Simpan"): KirimData("Edit")
        }
    }

    function VNama() {
        const d = document.getElementById("nama").value
        if (!d) {
            document.getElementById("alert_nama").innerHTML = "Nama barang tidak boleh kosong"
            return false
        } else {
            document.getElementById("alert_nama").innerHTML = ""
            return true
        }
    }

    function VHarga() {
        const d = document.getElementById("harga").value
        if (!d) {
            document.getElementById("alert_harga").innerHTML = "Harga tidak boleh kosong"
            return false
        } else {
            document.getElementById("alert_harga").innerHTML = ""
            return true
        }
    }

    function VStok() {
        const d = document.getElementById("stok").value
        if (d.length < 1) {
            document.getElementById("alert_stok").innerHTML = "Stok harus di isi"
            return false
        } else {
            document.getElementById("alert_stok").innerHTML = ""
            return true
        }
    }

    function KirimData(send) {
        var id_item = $('#id').val();
        var nama_barang = $('#nama').val();
        var harga = parseInt($('#harga').val());
        var stok = $('#stok').val();
        var data = {
            id_item: id_item,
            nama_barang: nama_barang,
            harga: harga,
            stok: stok
        }
        console.log(data)
        $.ajax({
            url: "<?php echo base_url() . 'barang/'; ?>" + send + "<?php echo '_Data'; ?>",
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
            $('#myModalInput').modal('toggle')
            location.reload()
        }

        function Timing(t) {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>