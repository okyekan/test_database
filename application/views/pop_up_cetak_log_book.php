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
                        <label class="col-sm-2 col-form-label" for="tgl1">Tanggal</label>
                        <div class="col-sm-10">
                            <input class="form-control" oninput="Check()" type="date" id="tgl1" name="tgl1" value=""></input>
                            <p id="alert_nama" style="color:red;"></p>
                        </div>
                    </div>
                    <div class="form-group row" id="gg" style="display: none;" class="row-fluid">
                        <label class="col-sm-2 col-form-label" for="tgl2">sampai&#160;</label>
                        <div class="col-sm-10">
                            <input class="form-control" oninput="Check()" type="date" id="tgl2" name="tgl2" value=""></input>
                            <p id="alert_nama" style="color:red;"></p>
                        </div>
                    </div>

                    <div class="btn-group row-fluid justify-content-end flex" style="justify-content: end;">
                        <input id="submit" class="btn btn-danger" type="submit" value="CETAK PDF" onclick="KirimData('PDF')">
                        <input id="submit" class="btn btn-success" type="submit" value="CETAK EXCEL" onclick="KirimData('Excel')">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <p id="demo" style="color:red;"></p>
                <p id="success_notif" style="color:green;"></p>
                <p id="redirect_time"></p>
            </div>
        </div>
    </div>
</div>

<script>
    // // Get the modal
    // var modal = document.getElementById("myModal");

    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];

    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //     modal.style.display = "none";
    // }

    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }

    function Check() {
        const c = document.getElementById("tgl1")
        const d = c.value
        var f = document.getElementById("gg")
        var g = document.getElementById("tgl2")
        
        if (d == "") {
            f.style.display = "none"
        } else {
            f.style.display = "flex"
            g.setAttribute('min', d)
        }

        if (g.value != "") {
            c.setAttribute('max', g.value)
        }
    }

    function KirimData(file) {
        var tgl1 = $('#tgl1').val();
        var tgl2 = $('#tgl2').val();
        var nomor = $('#nomor').val();
        if (nomor != '') {
            if (tgl1 == '') {
                tgl1 = 0
            }
            if (tgl2 == '') {
                tgl2 = 0
            }
        }
        var data = {
            tgl1: tgl1,
            tgl2: tgl2,
            nomor: nomor,
        }
        console.log(data)
        $.ajax({
            url: "<?php echo base_url(); ?>log_book/Cetak" + file + "/" + tgl1 + "/" + tgl2, // + tgl1 + "=" + tgl2 + "=" + nomor,
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
            window.open("<?php echo base_url(); ?>log_book/Cetak" + file + "/" + tgl1 + "/" + tgl2 /* + tgl1 + "=" + tgl2 + "=" + nomor*/ , "_blank")
        }

        function Timing(t) {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>