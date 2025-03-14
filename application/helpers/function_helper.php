<?php
function IdGen()
{
    date_default_timezone_set("Asia/Jakarta");

    $id = date('YmdHis');
    return ($id);
}
function KodeGen($array)
{
    date_default_timezone_set("Asia/Jakarta");
    $id = date('Ymd');
    $i = 0;
    foreach ($array as $row) {
        if (substr($row->kode, 0, 8) == $id) {
            $sub = (int) substr($row->kode, 8, 5);
            ($sub > $i) ? $i = $sub : '';
        }
    }
    $lastId = sprintf("%04s", $i + 1);
    return ($id . $lastId);
}
function PageStructure($page, $pages, $maxLength)
{
    if ($pages <= $maxLength) {
        $arr = range(1, $pages);
    } else if ($page <= 3 + (int)floor(($maxLength - 5) / 2)) {
        $arr = range(1, $maxLength - 1);
        $arr[$maxLength - 2] = 0;
        $arr[$maxLength - 1] = $pages;
    } else if ($page >= $pages - (int)ceil(($maxLength - 5) / 2) - 2) {
        $arr = range($pages - $maxLength + 1, $pages);
        $arr[0] = 1;
        $arr[1] = 0;
    } else {
        $arr = range($page - (int)floor(($maxLength - 1) / 2), $page + (int)ceil(($maxLength - 1) / 2));
        $arr[0] = 1;
        $arr[$maxLength - 1] = $pages;
        $arr[1] = 0;
        $arr[$maxLength - 2] = 0;
    }
    return $arr;
}
function GeneratePagination($total, $limit = 5, $offset = 0)
{
    $maxLength = 7;
    $pages = (int)ceil($total / $limit);
    $page = (int)ceil($offset / $limit) + 1;
    $gropen = '<div class="row-fluid"><div class="span9"></div><div id="tombol" class="span3 btn-group">';
    $grclose = '</div></div><br>';
    $btopen1 = '<button onclick="';
    $btopen1b = '<button class="btn" data-toggle="modal" data-target="#myModal"';
    $btopen2 = '" class="btn"';
    $disabled = ' disabled';
    $btopen3 = '>';
    $pop_up = ' <div class="modal" id="myModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Ke Halaman:</h4>
                            </div>
                            <div class="modal-body">
                                <input type="number" id="jump_page" min="1" max="' . $pages . '" name="jump_page"></input>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="RefreshTabel(($(\'#jump_page\').val()-1)*$(\'#limit\').val(),$(\'#limit\').val())">Jump</button>
                            </div>
                        </div>
                    </div>
                </div>';
    // <div id="pageModal" class="modal" style="display:none">
    //                 <div class="modal-content" style="padding: 20px;padding-bottom:10px">
    //                     <span id="pageNaviClose" class="close flex" style="border-radius: 5px;opacity: 0.8;color:white;background-color:rgb(255, 0, 0, 1);height:40px;width:40px">
    //                         &times;
    //                     </span>
    //                     <form name="input_form" method="post" action="" onsubmit="return false">
    //                         <div class="row-fluid">
    //                             <label for="jump_page">Ke Halaman:</label>
    //                             <input required type="number" id="jump_page" min="1" max="' . $pages . '" name="jump_page"></input>
    //                         </div>

    //                         <div class="row-fluid justify-content-end flex" style="justify-content: end;">
    //                             <input class="btn btn-success" type="submit" value="JUMP" onclick="RefreshTabel(($(\'#jump_page\').val()-1)*$(\'#limit\').val(),$(\'#limit\').val())">
    //                         </div>
    //                     </form>
    //                 </div>
    //             </div>';
    $btclose = '</button>';
    $arr = PageStructure($page, $pages, $maxLength);

    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == 0) {
            //render '..'
            $gropen = $gropen . $btopen1b;
            ($arr[$i] == $page) ? $gropen = $gropen . $disabled : '';
            $gropen = $gropen . $btopen3 . "..." . $btclose;
        } else {
            //render number
            $gropen = $gropen . $btopen1 . "RefreshTabel(" . ($arr[$i] - 1) . "*$('#limit').val(),$('#limit').val())" . $btopen2;
            ($arr[$i] == $page) ? $gropen = $gropen . $disabled : '';
            $gropen = $gropen . $btopen3 . $arr[$i] . $btclose;
        }
    }
    $gropen = $gropen . $grclose;
    if ($pages > $maxLength) {
        $gropen = $gropen . $pop_up;
    }
    return $gropen;
}

function CetakDesc($tabel, $jenis, $awal, $akhir)
{
    $str = '';
    if ($jenis == "Create") {
        if ($tabel == "Transaksi") {
            $str = "Menambah data " . $akhir[2];
        } else {
            $str = "Menambah data " . $akhir[1];
        }
    } else if ($jenis == "Delete") {
        $str = "Menghapus data " . $awal[1];
    } else {
        $first = true;
        for ($i = 0; $i < sizeof($awal); $i++) {
            if ($awal[$i] != $akhir[$i]) {
                if (!$first) {
                    $str = $str . " - ";
                }
                $str = $str . "Mengubah dari " . $awal[$i] . " menjadi " . $akhir[$i];
                $first = false;
            }
        }
    }
    return $str;
}
