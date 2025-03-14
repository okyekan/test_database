<div class="modal" id="myModalInput" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form <?php echo $aksi; ?> Data</h4>
            </div>
            <div class="modal-body">
                <form name="input_form" method="post" action="" onsubmit="return false">
                    <input type="hidden" id="id" name="id" value="<?php if (isset($row->kode)) echo $row->kode; ?>"></input>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="nama">Nama Customer</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="nama" name="nama" value="<?php if (isset($row->customer)) echo $row->customer; ?>"></input>
                            <p id="alert_nama" style="color:red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-12 col-form-label" for="barang">Listing Item:</label>
                        <div class="col-md-12">
                            <div class="form-group clearfix">
                                <div class="col-md-3"><input id="barang" type="text" class="form-control"></div>
                                <div class="col-md-2"><input id="qty" type="text" class="form-control"></div>
                                <div class="col-md-3"><input id="harga" type="text" class="form-control" value="Harga" readonly></div>
                                <div class="col-md-3"><input id="total" type="text" class="form-control" value="Total" readonly></div>
                                <div class="col-md-1">
                                    <button class="btn btn-success" type="button">+</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th></th>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><input type="text" class="form-control" readonly></td>
                                        <td><button class="btn btn-danger" type="button">-</button></td>
                                    </tr>
                                    <tr>
                                        <td>Total harga</td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp.------</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- <ul class="list-group" style="max-height: 150px;margin-bottom: 10px;overflow:scroll;-webkit-overflow-scrolling: touch;">
                                <li class="input-group"><span class="input-group-addon">Barang A</span><span class="input-group-addon">Rp.10.000,00</span><span class="input-group-addon">10</span><span class="input-group-addon">Total</span><span class="input-group-addon">Rp.100.000,00</span><span class="input-group-btn"><button class="btn btn-danger" type="button">-</button></span></li>
                                <li class="input-group"><span class="input-group-addon">Barang B</span><span class="input-group-addon">Rp.50.000,00</span><span class="input-group-addon">1</span><span class="input-group-addon">Total</span><span class="input-group-addon">Rp.50.000,00</span><span class="input-group-btn"><button class="btn btn-danger" type="button">-</button></span></li>
                                <li class="input-group"><span class="input-group-addon">Barang C</span><span class="input-group-addon">Rp.20.000,00</span><span class="input-group-addon">2</span><span class="input-group-addon">Total</span><span class="input-group-addon">Rp.40.000,00</span><span class="input-group-btn"><button class="btn btn-danger" type="button">-</button></span></li>
                                <li class="input-group"><span class="input-group-addon">Barang D</span><span class="input-group-addon">Rp.10.000,00</span><span class="input-group-addon">10</span><span class="input-group-addon">Total</span><span class="input-group-addon">Rp.100.000,00</span><span class="input-group-btn"><button class="btn btn-danger" type="button">-</button></span></li>
                                <li class="input-group"><span class="input-group-addon">Barang E</span><span class="input-group-addon">Rp.10.000,00</span><span class="input-group-addon">10</span><span class="input-group-addon">Total</span><span class="input-group-addon">Rp.100.000,00</span><span class="input-group-btn"><button class="btn btn-danger" type="button">-</button></span></li>
                                <li class="input-group"><span class="input-group-addon">Barang F</span><span class="input-group-addon">Rp.10.000,00</span><span class="input-group-addon">10</span><span class="input-group-addon">Total</span><span class="input-group-addon">Rp.100.000,00</span><span class="input-group-btn"><button class="btn btn-danger" type="button">-</button></span></li>
                            </ul> -->
                    </div>
            </div>

            <div class="row-fluid justify-content-end flex" style="justify-content: end;">
                <input class="btn btn-success" type="submit" value="SUBMIT" onclick="Validasi()">
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
    $('#qty').ready(function() {
        if ($('#barang').val != '' && $('#qty').val != '') {
            document.getElementById('total') = $('#barang').val * $('#qty').val
        }
    })
    $(function() {
        $('#nama').combogrid({
            delay: 500,
            panelWidth: 500,
            mode: 'remote',
            url: 'orang/Table',
            idField: 'id',
            textField: 'nama',
            columns: [
                [{
                        field: 'nama',
                        title: 'Nama',
                    },
                    {
                        field: 'umur',
                        title: 'Umur',
                        align: 'right',
                    },
                    {
                        field: 'jenis_kelamin',
                        title: 'Jenis Kelamin',
                    },
                    {
                        field: 'alamat',
                        title: 'Alamat',
                    }
                ]
            ],
            fitColumns: true,
        });

        $('#barang').combogrid({
            delay: 500,
            panelWidth: 400,
            mode: 'remote',
            url: 'barang/Table',
            idField: 'id',
            textField: 'nama',
            columns: [
                [{
                        field: 'kode',
                        title: 'Kode Barang',
                    },
                    {
                        field: 'nama',
                        title: 'Nama Item',
                        width: 1
                    },
                    {
                        field: 'harga',
                        title: 'Harga',
                        align: 'right'
                    },
                    {
                        field: 'stok',
                        title: 'Stok',
                    }
                ]
            ],
            fitColumns: true,
            onSelect: function(index, row) {
                var harga = row['harga']
                document.getElementById('harga').value = harga
            }
        });
    });

    function KirimData(send) {
        var id = $('#id').val();
        var waktu = "<?php if (isset($row->waktu)) echo $row->waktu; ?>"
        var nama = $('#nama').val();
        var harga = parseInt($('#harga').val());
        var data = {
            id_transaksi: id,
            waktu: waktu,
            akun: nama,
            jumlah: harga,
        }
        console.log(data)
        $.ajax({
            url: "<?php echo base_url() . 'transaksi/'; ?>" + send + "<?php echo '_Data'; ?>",
            type: "POST",
            data: data,
            success: function() {
                document.getElementById("success_notif").innerHTML = "Data Terkirim"
                setTimeout(PopSuccess(), 3000)
            }
        })

        function PopSuccess() {
            var frm = document.getElementsByName("input_form")[0]
            frm.reset()
            $('#myModalInput').modal('toggle')
            //location.reload()
        }

        function Timing(t) {
            // const currTime = new Date().getTime
            // document.getElementsById("redirect_time").innerHTML = "Redirect in "+(currTime - t)+" second(s)";
        }
        return false
    }
</script>