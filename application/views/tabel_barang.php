<div class="span10">
  <h1>Tabel Barang</h1>
  <button class="span2 btn btn-primary" type="button" style="border: 1px solid black"
    onclick="TambahData()">Input Data
  </button><br><br>
  <table width=100%>
    <tr style="background-color:rgba(62, 49, 159, 0.36)">
      <th>
        <div>ID</div>
      </th>
      <th>
        <div>Nama Barang</div>
      </th>
      <th>
        <div>Harga</div>
      </th>
      <th>
        <div>Stok</div>
      </th>
      <th>
        <div>Aksi</div>
      </th>
    </tr>
    <?php foreach ($all_data as $show): ?>
      <tr style="background-color:rgb(228, 241, 248)">
        <td><?php echo $show->id_item ?></td>
        <td><?php echo $show->nama_barang ?></td>
        <td>
          <div style="display:flex;justify-content:space-between">
            <p><?php echo "Rp." ?></p>
            <p><?php echo number_format($show->harga, 2, ",", ".") ?></p>
          </div>
        </td>
        <td><?php echo $show->stok ?></td>
        <td>
          <button type="button" class="span6 btn btn-warning" style="border: 2px solid black"
            onclick="UbahData('<?php echo $show->id_item; ?>')">Ubah
          </button>
          <button type="button" class="span6 btn btn-danger" style="border: 2px solid black"
            onclick="HapusData('<?php echo $show->id_item; ?>','<?php echo $show->nama_barang; ?>')">Hapus
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <script type="text/javascript">
    function HapusData(x, y) {
      if (confirm("Apakah anda yakin untuk menghapus data " + y + "?")) {
        data = {
          id_item: x
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
        id_item: x
      }
      AjaxSend("Ubah_Data", data)
    }

    function AjaxSend(url, vdata) {
      $.ajax({
        url: "<?php echo base_url() . 'barang'; ?>/" + url,
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