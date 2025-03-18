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
                            <input required class="form-control" type="text" id="nama" name="nama" value="<?php if (isset($row->customer)) echo $row->customer; ?>"></input>
                            <p id="alert_nama" style="color:red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-12 col-form-label" for="barang">Listing Item:</label>
                        <div class="col-md-12">
                            <div class="form-group clearfix">
                                <table class="table">
                                    <tr>
                                        <td><input required style="width:150px;" id="barang" type="text" class="form-control"></td>
                                        <td><input required id="qty" type="number" value="1" min="1" max="99" class="form-control"></td>
                                        <td><input id="harga" type="text" class="form-control text-right" value="Harga" readonly></td>
                                        <td><input id="total" type="text" class="form-control text-right" value=0 readonly></td>
                                        <td><button id="addToCart" class="btn btn-success" type="button">+</button></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table id="cart" class="table">
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th></th>
                                        <p id="warn" style="color:red"></p>
                                    </tr>
                                    <!-- <tr>
                                        <td><input name="item-list" type="text" class="form-control"></td>
                                        <td><input name="qty-list" type="text" class="form-control"></td>
                                        <td><input name="harga-list" type="text" class="form-control" readonly></td>
                                        <td><input name="total-list" type="text" class="form-control" readonly></td>
                                        <td><button name="removeCart" class="btn btn-danger" type="button">-</button></td>
                                    </tr> -->
                                    <tr id="cartPrice" style="display:none">
                                        <td>Total harga</td>
                                        <td></td>
                                        <td class="text-right">Rp.</td>
                                        <td id="cartPriceTotal" class="text-right">------</td>
                                        <td>,00</td>
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
                    <div class="row-fluid justify-content-end flex" style="justify-content: end;">
                        <input class="btn btn-success" type="submit" value="SUBMIT" onclick="Validasi()">
                    </div>
                </form>
            </div>
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
    function GetTable() {
        var arr = []
        var table = []
        // $("tr", "#cart").each(function(idx) {
        //     arr.push($(this))
        //     $(":input", this).each(function(attr) {
        //         arr[idx].push($(this).val())
        //     })
        // })
        $("tr", "#cart").each(function(idx) {
            arr.push($(this))
            $(":input", this).each(function(attr) {
                arr[idx].push($(this).val())
            })
        })
        arr.shift()
        arr.pop()
        if (arr != '') {
            arr.forEach(function(x, idx) {
                table[idx] = {
                    id_barang: x[1],
                    qty: parseInt(x[4]),
                    harga: parseInt(x[5]),
                    total: parseInt(x[6])
                }
            })
        }
        return table
    }

    function UpdateTable(id, type, currIndex = -1) {
        var table = GetTable()
        var same = false
        var index = 0
        console.log(currIndex)
        table.forEach(function(x, idx) {
            if (id == x['id_barang'] && currIndex != idx + 1) {
                same = true
                index = idx
            }
        })
        if (type == 'C') {
            if (same) {
                MergeRow(id, index, currIndex)
            } else {
                CreateRow()
            }
        } else if (type == 'U') {
            console.log(same)
            if (same) {
                MergeRow(id, index, currIndex)
            }
        }
    }

    function CreateRow() {
        $('#warn').html("")
        var table = document.getElementById('cart')
        row = table.insertRow(1)
        row.insertCell(0).innerHTML = '<input required style="width:150px" name="item-list" type="text" class="form-control" value="' + $('#barang').val() + '">'
        row.insertCell(1).innerHTML = '<input required name="qty-list" type="number" min="1" max="' + $('#qty').attr('max') + '" class="form-control" value="' + $('#qty').val() + '"><br><p name="warning"></p>'
        row.insertCell(2).innerHTML = '<input name="harga-list" align="right" type="text" class="form-control text-right" value="' + $('#harga').val() + '" readonly>'
        row.insertCell(3).innerHTML = '<input name="total-list" align="right" type="text" class="form-control text-right" value="' + $('#total').val() + '" readonly>'
        row.insertCell(4).innerHTML = '<input name="index-list" type="hidden" value=""><button name="removeCart" class="btn btn-danger" type="button">-</button>'
        var cg = $(":text[name='item-list']:first")
        cg.combogrid({
            delay: 500,
            panelWidth: 400,
            mode: 'remote',
            url: 'barang/Table',
            idField: 'id',
            textField: 'nama',
            value: $('#barang').val(),
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
            onSelect: function(index, val) {
                var harga = val['harga']
                var row = cg.parents("tr")
                cgQty = row.children("td").children(":input[name='qty-list']")
                cgHarga = row.children("td").children(":text[name='harga-list']")

                cgHarga.val(harga)
                cgQty.attr("max", val['stok'])
                cgQty.val(Math.min(cgQty.val(), val['stok']))

                UpdateTable(row.children("td").children(":text:first").val(), 'U', row.index())
                Check2(row)
            }
        })
        UpdatePrice()
    }

    function MergeRow(id, mergeIdx, deleteIdx) {
        var par = $("#cart tr:eq(" + (mergeIdx + 1) + ")")
        var qty = par.children("td").children(":input[name='qty-list']")
        var total = 0
        var max = qty.attr('max')

        if (deleteIdx > -1) {
            var delPar = $("#cart tr:eq(" + (deleteIdx) + ")")
            var delQty = delPar.children("td").children(":input[name='qty-list']").val()

            total = parseInt(qty.val()) + parseInt(delQty)
            qty.val(Math.min(total, max));
            $(".combo-p").toggle(false)
            delPar.remove()
            par.animate({
                backgroundColor: 'rgb(209, 164, 28)'
            }, 50, function() {
                par.animate({
                    backgroundColor: '#FFFFFF'
                }, 2000)
            })
            Check2(par)
            console.log('deleted')
        } else {
            total = parseInt(qty.val()) + parseInt($("#qty").val())
            qty.val(Math.min(total, max))
            par.stop().animate({
                backgroundColor: 'rgb(209, 164, 28)'
            }, 50, function() {
                $(this).animate({
                    backgroundColor: '#FFFFFF'
                }, 'slow')
            })
            Check2(par)
        }
    }

    function UpdatePrice() {
        var table = GetTable()
        if (table == '') {
            $("#cartPrice").hide()
        } else {
            var total = 0
            table.forEach(function(x) {
                total += x.total
            })
            $("#cartPrice").show()
            $("#cartPriceTotal").text(total)
        }
    }

    function Check() {
        if ($('#harga').val() != 'Harga' && $('#qty').val() != '') {
            document.getElementById('total').value = $('#harga').val() * $('#qty').val()
        }
    }

    function Check2(par) {
        var qty = par.children("td").children(":input[name='qty-list']")
        var harga = par.children("td").children(":text[name='harga-list']")
        var total = par.children("td").children(":text[name='total-list']")
        var arr = []
        var newTotal = harga.val() * qty.val()
        total.val(newTotal)
        UpdatePrice()
    }

    // function AddToCart() {
    //     var table = document.getElementById('cart')
    //     row = table.insertRow(1)
    //     row.insertCell(0).innerHTML = '<input name="item-list" type="text" class="form-control" value="">'
    //     row.insertCell(1).innerHTML = '<input id="qty-list" type="number" value="1" required min="1" class="form-control" oninput="Check()">'
    //     row.insertCell(2).innerHTML = '<input name="harga-list" type="text" class="form-control" value="" readonly>'
    //     row.insertCell(3).innerHTML = '<input name="total-list" type="text" class="form-control" value="" readonly>'
    //     row.insertCell(4).innerHTML = '<button name="removeCart" class="btn btn-danger" type="button">-</button>'
    // }
    $("#qty").on("input", function() {
        Check()
    })
    $(document).on("click", ":button[name='removeCart']", function() {
        $(this).parents("tr").remove()
        UpdatePrice()
    })
    $(document).on("input", ":input[name='qty-list']", function() {
        var row = $(this).parents('tr')
        Check2(row)
    })
    $(function() {
        $('#addToCart').click(function() {
            if ($('#harga').val() > 0 && parseInt($('#qty').val()) <= parseInt($('#qty').attr('max'))) {
                UpdateTable($('#barang').val(), 'C')
            }
        })
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

        $("#barang").combogrid({
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
                $("#qty").attr("max", row['stok'])
                Check()
            }
        });
    });

    function Validasi() {
        var table = GetTable()
        if ($('#nama').val() == '') {
            $('#alert_nama').html("Nama mohon diisi")
        } else if (table == undefined || table == '') {
            $('#warn').html("Daftar item mohon diisi")
        } else {
            KirimData('Simpan', table)
        }
    }

    function KirimData(send, table) {
        var nama = $('#nama').val()
        var data = []
        table.forEach(function(x, idx) {
            data.push(nama+"/"+x['id_barang']+"/"+x['qty'])
        })
        var str = data.join('; ')
        console.log(data)
        $.ajax({
            url: "<?php echo base_url() . 'transaksi/' ?>" + send + "_Data",
            type: "POST",
            data: {str:str},
            success: function() {
                // document.getElementById("success_notif").innerHTML = "Data Terkirim"
                setTimeout(PopSuccess(), 3000)
                console.log(str)
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