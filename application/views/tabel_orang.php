<div class="span10">
  <h1>Tabel Orang</h1>
  <button class="span2 btn btn-primary" type="button" style="border: 1px solid black"
    onclick="TambahData()">Input Data
  </button><br><br>
  <table width=100%>
    <tr style="background-color:rgba(62, 49, 159, 0.36)">
      <th>
        <div class="justify-content-center">ID</div>
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
        <td><?php echo $show->id ?></td>
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
  <p id="pagination"></p>
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

    function AjaxSend(url, vdata) {
      $.ajax({
        url: "<?php echo base_url() . 'orang'; ?>/" + url,
        type: 'POST',
        data: vdata,
        success: function(xdata) {
          $('#pop_up_form').html(xdata);
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