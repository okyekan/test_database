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
                        <label class="col-sm-2 col-form-label" for="umur1">Umur</label>
                        <div class="col-sm-3">
                            <input class="form-control" oninput="Check()" type="number" id="umur1" min="0" name="umur1"></input>
                            <p id="alert_umur" style="color:red;"></p>
                        </div>
                        <div id="gg" style="display: none;">
                            <label class="col-sm-2 col-form-label" for="umur2">sampai</label>
                            <div class="col-sm-5">
                                <input class="form-control" oninput="Check()" type="number" id="umur2" min="0" name="umur2"></input>
                                <p id="alert_umur" style="color:red;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select id="jenis_kelamin" oninput="Check()" class="form-control">
                                <option value=""></option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea oninput="Check()" class="form-control" id="alamat" name="alamat" rows="4" cols="50"></textarea>
                        <p id="alert_alamat" style="color:red;"></p>
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
        var b1 = document.getElementById("umur1")
        var b2 = document.getElementById("umur2")
        var gg = document.getElementById("gg")
        var c = document.getElementById("jenis_kelamin")
        var d = document.getElementById("alamat")

        if (b1.value == "") {
            gg.style.display = "none"
        } else {
            gg.style.display = "flex"
            b2.setAttribute('min', b1.value)
        }

        if (b2.value != "") {
            b1.setAttribute('max', b2.value)
        }
    }

    function KirimData(file) {
        var nama = $('#nama').val();
        var umur1 = $('#umur1').val();
        var umur2 = $('#umur2').val();
        var jenis_kelamin = $('#jenis_kelamin').val();
        var alamat = $('#alamat').val();
        if (nama == '') {
            nama = 0
        }
        if (umur1 == '') {
            umur1 = 0
        }
        if (umur2 == '') {
            umur2 = 0
        }
        if (jenis_kelamin == '') {
            jenis_kelamin = 0
        }
        if (alamat == '') {
            alamat = 0
        }
        var data = {
            nama: nama,
            umur1: umur1,
            umur2: umur2,
            jenis_kelamin: jenis_kelamin,
            alamat: alamat
        }
        console.log(data)
        $.ajax({
            url: "<?php echo base_url(); ?>orang/Cetak" + file + "/" + nama + "/" + umur1 + "/" + umur2 + "/" + jenis_kelamin + "/" + alamat, // + tgl1 + "=" + tgl2 + "=" + nomor,
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
            window.open("<?php echo base_url(); ?>orang/Cetak" + file + "/" + nama + "/" + umur1 + "/" + umur2 + "/" + jenis_kelamin + "/" + alamat /* + tgl1 + "=" + tgl2 + "=" + nomor*/ , "_blank")
        }

        function Timing(t) {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>