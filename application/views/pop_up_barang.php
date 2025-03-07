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
                    <label for="nama">Nama Barang:</label>
                    <input required type="text" id="nama" name="nama" value="<?php if (isset($row->nama_barang)) echo $row->nama_barang; ?>"></input>
                    <p id="alert_nama" style="color:red;"></p>
                </div>
                <div class="row-fluid">
                    <label for="harga">Harga:</label>
                    <input required type="text" id="harga" min="0" name="harga" value="<?php if (isset($row->harga)) echo $row->harga; ?>"></input>
                    <p id="alert_harga" style="color:red;"></p>
                </div>
                <div class="row-fluid">
                    <label for="stok">Stok:</label>
                    <input required type="text" id="stok" min="0" name="stok" value="<?php if (isset($row->stok)) echo $row->stok; ?>"></input>
                    <p id="alert_stok" style="color:red;"></p>
                </div>

                <div class="row-fluid justify-content-end flex" style="justify-content: end;">
                    <input class="btn btn-success" type="submit" value="SUBMIT" onclick="Validasi()">
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
            modal.style.display = "none";
            location.reload()
        }

        function Timing(t) {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>