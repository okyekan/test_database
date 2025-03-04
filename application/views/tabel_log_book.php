<div class="span10">
    <h1>Tabel Log Book</h1>
    <table width=100%>
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
                        echo "Menambah data " . $akhir[1];
                    } else if ($jenis == "Delete") {
                        echo "Menghapus data " . $awal[1];
                    } else {
                        $first = true;
                        for ($i = 0; $i < sizeof($awal); $i++) {
                            if (!$first) {
                                echo "\r\n";
                            }
                            if ($awal[$i] != $akhir[$i]) {
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
    <div class="row-fluid">
        <div class="span9"></div>
        <div class="span3 btn-group">
            <button class="btn">
                < Prev</button>
                    <button class="btn">1</button>
                    <button class="btn">Next ></button>
        </div>
    </div><br><br>
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
                    location.reload()
                }
            })
        }
    </script>
</div>