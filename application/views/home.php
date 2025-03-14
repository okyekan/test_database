<h1>Welcome Home!</h1>
<h6><?php echo md5('qwerty') ?></h6>

<input id="cc" name="dept" value="">
<?php echo '<pre>';
print_r($this->session->all_userdata());
exit;
echo '</pre>'; ?>
<script>
    $(function() {
        $('#cg').combogrid({
            delay: 500,
            mode: 'remote',
            url: 'orang/Table',
            idField: 'id',
            textField: 'nama',
            fitColumns: true,
            columns: [
                [{
                        field: 'nama',
                        title: 'Nama',
                        width: 80
                    },
                    {
                        field: 'umur',
                        title: 'Umur',
                        align: 'right',
                        width: 20
                    },
                    {
                        field: 'jenis_kelamin',
                        title: 'Jenis Kelamin',
                        width: 40
                    },
                    {
                        field: 'alamat',
                        title: 'Alamat',
                        width: 100
                    }
                ]
            ]
        });
    });
</script>