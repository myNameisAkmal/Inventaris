<html>
<head>
	<title>DATA MAHASISWA</title>
    <script src="<?php echo base_url('assets/JQuery.js') ?>"></script>
    <script src="<?php echo base_url('assets/UI/jquery-ui.min.js') ?>"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/UI/themes/dark-hive/jquery-ui.min.css') ?>">
    <script>
        $(document).ready(function() {
            //JQUERY START

            $("#alert").dialog({
                title : "ALERT !!!",
                modal : true,
                autoOpen : false,
                draggable : false,
                resizable : false,
                closeOnEscape : false,
                open : function (e, ui) {
                    $(".ui-dialog-titlebar-close", ui.dialog | ui).hide()
                },
                buttons : {
                    "Ok" : function() {
                        $(this).dialog("close");
//                        $('#show').table('refresh') ;
                        location.reload() ;
                    }
                }
            }) ;

            $('.del').click(function() {
                $.ajax({
                    type : 'POST',
                    url : "<?php echo base_url('Data/deleteData/') ?>" + $(this).attr('data'),
                    success : function (x) {
                        $('#alert').html('<p align=center>'+x+'</p>') ;
                        $('#alert').dialog('open') ;
                    }
                }) ;

                return false ;
            }) ;

            //JQUERY END
        }) ;
    </script>
</head>
<body>
<div id="alert">
</div>
<a href="<?php echo base_url()."Data/newData"?>">(+) Tambah Mahasiswa</a>

<?php
$bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] ;

$isi = count($mhs) ;
if ($isi < 1) {
    echo "<br><br><b>TIDAK ADA DATA SILAHKAN INPUT BARU</b>" ;
}
else {
    ?>
<!--    <div id="form">-->
    <table border="1" id="show">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Agama</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($mhs as $row) {
            $date = '' ;
            $date = new DateTime($row->tgl_lahir) ;

            echo "<tr>";
            echo "<td>$row->nim</td>";
            echo "<td>$row->nama</td>";
            echo "<td>".$date->format('d')." ".$bulan[(int)$date->format('m')]." ".$date->format('Y')."</td>";
            echo "<td>$row->agama</td>";
            echo "<td><a class='del' data='".$row->nim."' href='#'>Hapus Data</a> | <a class='upd' href='".base_url()."Data/editData/$row->nim'>Edit Data</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
<!--    </div>-->
    <?php
}
?>
</body>
</html>