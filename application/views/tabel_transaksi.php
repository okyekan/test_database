<div class="span10">
    <h1>Tabel Transaksi</h1>
    <button class="span2 btn btn-primary" type="button" style="border: 1px solid black"
        onclick="TambahData()">Input Data
    </button>
    <button class="span2 btn btn-success" type="button" style="border: 1px solid black"
        onclick="CetakData()">Cetak Data
    </button><br><br>
    <table>
        <tr style="background-color:rgba(62, 49, 159, 0.36)">
            <th>No. Transaksi</th>
            <th>Waktu</th>
            <th>Customer</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($all_data as $show): ?>
            <tr style="background-color:rgb(228, 241, 248)">
                <td><?php echo $show->id_transaksi ?></td>
                <td><?php echo $show->waktu ?></td>
                <td><?php echo $show->akun ?></td>
                <td>
                    <div style="display:flex;justify-content:space-between">
                        <p><?php echo "Rp." ?></p>
                        <p><?php echo number_format($show->jumlah, 2, ",", ".") ?></p>
                    </div>
                </td>
                <td>
                    <button type="button" class="span6 btn btn-warning" style="border: 2px solid black"
                        onclick="UbahData('<?php echo $show->id_transaksi; ?>')">Ubah
                    </button>
                    <button type="button" class="span6 btn btn-danger" style="border: 2px solid black"
                        onclick="HapusData('<?php echo $show->id_transaksi; ?>')">Hapus
                    </button>
                </td>
            <?php endforeach; ?>
            </tr>
    </table>
    <p id="pagination"></p>
    <script type="text/javascript">
        function HapusData(x) {
            if (confirm("Apakah anda yakin untuk menghapus data " + x + "?")) {
                data = {
                    id_transaksi: x
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

        function CetakData() {
            data = {}
            AjaxSend("Cetak_Data", data)
        }

        function UbahData(x) {
            data = {
                id_transaksi: x
            }
            AjaxSend("Ubah_Data", data)
        }

        function AjaxSend(url, vdata) {
            $.ajax({
                url: "<?php echo base_url() . 'transaksi'; ?>/" + url,
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

</div>
<div id="pop_up_form">
</div>