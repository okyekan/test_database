<div class="span10">
    <h1>Tabel Log Book</h1>
    <button onclick="AjaxSend('Cetak_Data')" class="span2 btn btn-success" type="button" style="border: 1px solid black">
        Cetak Data
    </button><br /><br />
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
                <div class="justify-content-center">Waktu</div>
            </th>
            <th>
                <div class="justify-content-center">Akun</div>
            </th>
            <th>
                <div class="justify-content-center">Log</div>
            </th>
            <th>
                <div class="justify-content-center">Jenis perubahan</div>
            </th>
            <th>
                <div class="justify-content-center">Tabel perubahan</div>
            </th>
            <th>
                <div class="justify-content-center">Aksi</div>
            </th>
        </tr>
        <?php foreach ($all_data as $show): ?>
            <tr style="background-color:rgb(228, 241, 248)">
                <?php $jenis = $show->jenis;
                $awal = explode(";", $show->awal);
                $akhir = explode(";", $show->akhir); ?>
                <td><?php echo $show->waktu ?></td>
                <td><?php echo $show->akun ?></td>
                <td>
                    <?php
                    //Mencetak text penjelasan
                    if ($jenis == "Create") {
                        if ($show->tabel == "Transaksi") {
                            echo "Menambah data " . $akhir[2];
                        } else {
                            echo "Menambah data " . $akhir[1];
                        }
                    } else if ($jenis == "Delete") {
                        echo "Menghapus data " . $awal[1];
                    } else {
                        $first = true;
                        for ($i = 0; $i < sizeof($awal); $i++) {
                            if ($awal[$i] != $akhir[$i]) {
                                if (!$first) {
                                    print(" - ");
                                }
                                echo "Mengubah dari " . $awal[$i] . " menjadi " . $akhir[$i];
                                $first = false;
                            }
                        }
                    }
                    ?>
                </td>
                <td><?php echo $show->jenis ?></td>
                <td><?php echo $show->tabel ?></td>
                <td>
                    <button type="button" class="span12 btn btn-danger" style="border: 2px solid black"
                        onclick="HapusData('<?php echo $show->waktu; ?>','<?php echo $show->akun; ?>')">Hapus
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="pull-right"><?php echo $pagination ?></div>
    <script type="text/javascript">
        function HapusData(x, y) {
            if (confirm("Apakah anda yakin untuk menghapus log milik " + y + "?")) {
                data = {
                    waktu: x
                }
                AjaxSend("Hapus", data)
            } else {
                console.log("no")
            }
        }

        function AjaxSend(url, data) {
            $.ajax({
                url: "<?php echo base_url() . 'log_book'; ?>/" + url,
                type: 'POST',
                data: data,
                success: function(xdata) {
                    $('#pop_up_form').html(xdata);
                    $('#myModalInput').modal()
                    if (url == "Hapus")
                        location.reload()
                }
            })
        }
    </script>
</div>
<div id="pop_up_form">
</div>