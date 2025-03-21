<div class="span10">
  <h1>Tabel Orang</h1>
  <button class="span2 btn btn-primary" type="button" style="border: 1px solid black"
    onclick="TambahData()">Input Data
  </button>
  <button onclick="CetakData()" class="span2 btn btn-success" type="button" style="border: 1px solid black">
    Cetak Data
  </button><br><br>
  <table class="table table-bordered" style="width:100%">
    <tr>
      <label class="span">
        Tampilkan
        <select tabindex="-1" oninput="RefreshTabel(0,$('#limit').val())" style="width: 75px" name="limit" id="limit">
          <option value="5" <?php if ($limit == 5) {
                              echo "selected";
                            } ?>>5</option>
          <option value="10" <?php if ($limit == 10) {
                                echo "selected";
                              } ?>>10</option>
          <option value="25" <?php if ($limit == 25) {
                                echo "selected";
                              } ?>>25</option>
          <option value="50" <?php if ($limit == 50) {
                                echo "selected";
                              } ?>>50</option>
          <option value="100" <?php if ($limit == 100) {
                                echo "selected";
                              } ?>>100</option>
        </select>
        entri
      </label>
    </tr>
    <tr style="background-color:rgba(62, 49, 159, 0.36)">
      <th>
        <div class="justify-content-center">Kode</div>
      </th>
      <th>
        <div class="justify-content-center">Nama</div>
      </th>
      <th>
        <div class="justify-content-center">Umur</div>
      </th>
      <th>
        <div class="justify-content-center">Jenis Kelamin</div>
      </th>
      <th>
        <div class="justify-content-center">Alamat</div>
      </th>
      <th>
        <div class="justify-content-center">Aksi</div>
      </th>
    </tr>
    <?php foreach ($all_data as $show): ?>
      <tr style="background-color:rgb(228, 241, 248)">
        <td><?php echo $show->kode ?></td>
        <td><?php echo $show->nama ?></td>
        <td><?php echo $show->umur ?></td>
        <td><?php echo $show->jenis_kelamin ?></td>
        <td><?php echo $show->alamat ?></td>
        <td>
          <button type="button" class="span6 btn btn-warning" style="border: 2px solid black"
            onclick="UbahData('<?php echo $show->id; ?>')">Ubah
          </button>
          <button type="button" class="span6 btn btn-danger" style="border: 2px solid black"
            onclick="HapusData('<?php echo $show->id; ?>','<?php echo $show->nama; ?>')">Hapus
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <div class="pull-right"><?php echo $pagination ?></div>
  <script type="text/javascript">
    function HapusData(x, y) {
      if (confirm("Apakah anda yakin untuk menghapus data " + y + "?")) {
        data = {
          id: x
        }
        AjaxSend("Hapus", data)
      } else {
        console.log("no")
      }
    }

    function TambahData() {
      data = {}
      AjaxSend("Tambah_Data", data)
    }

    function UbahData(x) {
      data = {
        id: x
      }
      AjaxSend("Ubah_Data", data)
    }

    function CetakData() {
      data = {}
      AjaxSend("Cetak_Data", data)
    }

    function AjaxSend(url, vdata) {
      $.ajax({
        url: "<?php echo base_url() . 'orang'; ?>/" + url,
        type: 'POST',
        data: vdata,
        success: function(xdata) {
          $('#pop_up_form').html(xdata);
          $('#myModalInput').modal()
          if (url == "Hapus") {
            location.reload()
          }
        }
      })
    }
  </script>
</div>
<div id="pop_up_form">
</div>