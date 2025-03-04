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
                <input type="hidden" id="id" name="id" value="<?php if (isset($row->id)) echo $row->id; ?>"></input>
                <div class="row-fluid">
                    <label for="">Nama:</label>
                    <input required type="text" id="nama" name="nama" value="<?php if (isset($row->nama)) echo $row->nama; ?>"></input>
                    <p id="alert_nama" style="color:red;"></p>
                </div>
                <div class="row-fluid">
                    <label for="">Umur:</label>
                    <input required type="number" id="umur" min="0" name="umur" value="<?php if (isset($row->umur)) echo $row->umur; ?>"></input>
                    <p id="alert_umur" style="color:red;"></p>
                </div>
                <div class="row-fluid">
                    <label for="">Jenis Kelamin:</label>
                    <div class="span2">
                        <input required type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Laki-laki" <?php if (isset($row->jenis_kelamin)) {
                                                                                                                    if ($row->jenis_kelamin == "Laki-laki") {
                                                                                                                        echo "checked";
                                                                                                                    };
                                                                                                                } ?>></input>
                        <label for="laki_laki">Laki-laki</label>
                    </div>
                    <div class="span2">
                        <input required type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Perempuan" <?php if (isset($row->jenis_kelamin)) {
                                                                                                                    if ($row->jenis_kelamin == "Perempuan") {
                                                                                                                        echo "checked";
                                                                                                                    };
                                                                                                                } ?>></input>
                        <label for="perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="row-fluid">
                    <p id="alert_jk" style="color:red;"></p>
                </div>
                <div class="row-fluid">
                    <label for="alamat">Alamat:</label>
                    <textarea required id="alamat" name="alamat" rows="4" cols="50"><?php if (isset($row->alamat)) echo $row->alamat; ?></textarea>
                    <p id="alert_alamat" style="color:red;"></p>
                </div>

                <div class="row-fluid justify-content-end flex" style="justify-content: end;">
                    <input class="btn btn-success" type="submit" value="SUBMIT" onclick="Validasi()">
                </div>
            </form>
        </div>
        </form>
        <p id="demo"></p>
        <p id="success_notif" style="color:green;"></p>
        <p id="redirect_time"></p>
    </div>

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
        if (VNama() & VUmur() & VJK() & VAlmt()) {
            ("<?php echo $aksi ?>" == "Tambah") ? KirimData("Simpan"): KirimData("Edit")
        }
    }

    function VNama() {
        const d = document.getElementById("nama").value
        if (!d) {
            document.getElementById("alert_nama").innerHTML = "Nama tidak boleh kosong"
            return false
        } else {
            document.getElementById("alert_nama").innerHTML = ""
            return true
        }
    }

    function VUmur() {
        const d = document.getElementById("umur").value
        if (!d) {
            document.getElementById("alert_umur").innerHTML = "Umur tidak boleh kosong"
            return false
        } else if (d < 17) {
            document.getElementById("alert_umur").innerHTML = "Umur pendaftar minimal 17 thn"
            return false
        } else {
            document.getElementById("alert_umur").innerHTML = ""
            return true
        }
    }

    function VJK() {
        if (!$('#jenis_kelamin:checked').val()) {
            document.getElementById("alert_jk").innerHTML = "Pilih jenis kelamin"
            return false
        } else {
            document.getElementById("alert_jk").innerHTML = ""
            return true
        }
    }

    function VAlmt() {
        const d = document.getElementById("alamat").value
        if (d.length < 10) {
            document.getElementById("alert_alamat").innerHTML = "Alamat minimal 10 karakter"
            return false
        } else {
            document.getElementById("alert_alamat").innerHTML = ""
            return true
        }
    }

    function KirimData(send) {
        var id = $('#id').val();
        var nama = $('#nama').val();
        var umur = parseInt($('#umur').val());
        var jenis_kelamin = $('#jenis_kelamin:checked').val();
        var alamat = $('#alamat').val();
        var data = {
            id: id,
            nama: nama,
            umur: umur,
            jenis_kelamin: jenis_kelamin,
            alamat: alamat
        }
        $.ajax({
            url: "<?php echo base_url() . 'orang/'; ?>" + send + "<?php echo '_Data'; ?>",
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