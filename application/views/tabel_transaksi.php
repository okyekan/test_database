<div class="span10">
    <h1>Tabel Transaksi</h1>
    <button class="span2 btn btn-primary" type="button" style="border: 1px solid black"
        onclick="TambahData()">Input Data
    </button>
    <button class="span2 btn btn-success" type="button" style="border: 1px solid black"
        onclick="CetakData()">Cetak Data
    </button><br><br>
    <div class="">
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
                <th>No. Transaksi</th>
                <th>Waktu</th>
                <th>Customer</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga Barang</th>
                <th>Total Transaksi</th>
                <th>Aksi</th>
            </tr>
            <?php $span = '';$total = 0;
            foreach ($all_data as $show): ?>
                <tr style="background-color:rgb(228, 241, 248)">
                    <?php if ($span != $show['kode_transaksi']) {
                        echo "<td rowspan='" . $show['pembelian'] . "'>" . $show['kode_transaksi'] . "</td>";

                        echo "<td rowspan='" . $show['pembelian'] . "'>" . $show['waktu'] . "</td>";

                        echo "<td rowspan='" . $show['pembelian'] . "'>" . $show['nama_customer'] . "</td>";
                    } ?>
                    <td><?php echo $show['nama_barang'] ?></td>
                    <td><?php echo $show['qty'] ?></td>
                    <td>
                        <div style="display:flex;justify-content:space-between">
                            <p><?php echo "Rp." ?></p>
                            <p><?php echo number_format($show['harga'], 2, ",", ".") ?></p>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex;justify-content:space-between">
                            <p><?php echo "Rp." ?></p>
                            <p><?php echo number_format(($show['harga'] * $show['qty']), 2, ",", ".") ?></p>
                        </div>
                    </td>
                    <?php
                    if ($span != $show['kode_transaksi']) {
                        echo "<td rowspan='" . $show['pembelian'] . "'><div style='display:flex;justify-content:space-between'><p>Rp.</p><p>" . number_format(($show['total']), 2, ",", ".") . "</p></div></td>";
                    } ?>
                    <td>
                        <button type="button" class="span6 btn btn-warning" style="border: 2px solid black"
                            onclick="UbahData('<?php echo $show['kode_transaksi']; ?>')">Ubah
                        </button>
                        <button type="button" class="span6 btn btn-danger" style="border: 2px solid black"
                            onclick="HapusData('<?php echo $show['kode_transaksi']; ?>')">Hapus
                        </button>
                    </td>
                </tr>
                <?php $span = $show['kode_transaksi'];
            endforeach; ?>
        </table>
    </div>
    <div class="pull-right"><?php echo $pagination ?></div>
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