<?php
function IdGen()
{
    date_default_timezone_set("Asia/Jakarta");

    $id = date('YmdHis');
    return ($id);
}
function NoTransaksiGen($array)
{
    date_default_timezone_set("Asia/Jakarta");
    $id = date('Ymd');
    $i = 0;
    foreach ($array as $row) {
        if (substr($row->id_transaksi, 0, 8) == $id) {
            $sub = (int) substr($row->id_transaksi, 8, 5);
            ($sub > $i) ? $i = $sub : '';
        }
    }
    $lastId = sprintf("%04s", $i + 1);
    return ($id . $lastId);
}
