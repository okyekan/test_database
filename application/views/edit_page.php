<h1 style="color:blue">
    Form <?php echo $aksi;?> Data
</h1>
<form name="input_form" method="post" action="" onsubmit="return false">
    <label for="">Nama:</label><br>
    <input type="text" id="nama" name="nama" value="<?php if(isset($row->nama)) echo $row->nama; ?>"></input>
    <p id="alert_nama" style="color:red;"></p>
    <label for="">Umur:</label><br>
    <input type="number" id="umur" min="0" name="umur" value="<?php if(isset($row->umur)) echo $row->umur; ?>"></input>
    <p id="alert_umur" style="color:red;"></p>
    <label for="">Jenis Kelamin:</label><br>
    <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Laki-laki" <?php if(isset($row->jenis_kelamin)) {if($row->jenis_kelamin=="Laki-laki") {echo "checked";};} ?>></input>
    <label for="laki_laki">Laki-laki</label>
    <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Perempuan" <?php if(isset($row->jenis_kelamin)) {if($row->jenis_kelamin=="Perempuan") {echo "checked";};} ?>></input>
    <label for="perempuan">Perempuan</label>
    <p id="alert_jk" style="color:red;"></p>
    <label for="alamat">Alamat:</label><br>
    <textarea id="alamat" name="alamat" rows="4" cols="50"><?php if(isset($row->alamat)) echo $row->alamat; ?></textarea>
    <p id="alert_alamat" style="color:red;"></p>
    
    <input type="submit" value="SUBMIT" onclick="Validasi()">
</form>
<p id="demo"></p>
<p id="success_notif"style="color:green;"></p>
<p id="redirect_time"></p>
<script src="<?php echo base_url().'assets/JQuery/jquery.js'; ?>"></script>
<script>
    function Validasi()
    {
        if (VNama()&VUmur()&VJK()&VAlmt()){KirimData()}
    }
    function VNama()
    {
        const d = document.getElementById("nama").value
        if(!d)
        {
            document.getElementById("alert_nama").innerHTML = "Nama tidak boleh kosong"
            return false
        }
        else
        {
            document.getElementById("alert_nama").innerHTML = ""
            return true
        }
    }
    function VUmur()
    {
        const d = document.getElementById("umur").value
        if(!d)
        {
            document.getElementById("alert_umur").innerHTML = "Umur tidak boleh kosong"
            return false
        }
        else if(d<17)
        {
            document.getElementById("alert_umur").innerHTML = "Umur pendaftar minimal 17 thn"
            return false
        }
        else 
        {
            document.getElementById("alert_umur").innerHTML = ""
            return true
        }
    }
    function VJK()
    {
        if(!$('#jenis_kelamin:checked').val())
        {
            document.getElementById("alert_jk").innerHTML = "Pilih jenis kelamin"
            return false
        }
        else 
        {
            document.getElementById("alert_jk").innerHTML = ""
            return true
        }
    }
    function VAlmt()
    {
        const d = document.getElementById("alamat").value
        if(d.length < 10)
        {
            document.getElementById("alert_alamat").innerHTML = "Alamat minimal 10 karakter"
            return false
        }
        else
        {
            document.getElementById("alert_alamat").innerHTML = ""
            return true
        }
    }
    function KirimData()
    {
        var nama = $('#nama').val();
        var umur = parseInt($('#umur').val());
        var jenis_kelamin = $('#jenis_kelamin:checked').val();
        var alamat = $('#alamat').val();
        var data = {nama:nama,umur:umur,jenis_kelamin:jenis_kelamin,alamat:alamat}
        console.log(data)
        $.ajax({
            url:"<?php echo base_url().'orang/Simpan'; ?>",
            type:"POST",
            data: data,
            success: function(data){
                document.getElementById("success_notif").innerHTML = "Data Terkirim"
                // const t = new Date().getTime
                setTimeout(Success(),3000)
                // setInterval(Timing(t),1000)
            }
        })
        function Success()
        {
            window.location.href = '<?php echo base_url().'orang'; ?>'
            var frm = document.getElementsByName("input_form")[0]
            frm.reset()
        }
        function Timing(t)
        {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>