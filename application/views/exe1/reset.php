<html>
<head>
    <title>MINE PAGE</title>
    <script src="<?php echo base_url('assets/JQuery.js') ?>"></script>
    <script src="<?php echo base_url('assets/UI/jquery-ui.min.js') ?>"></script>

    <!--    <script src="--><?php //echo base_url('assets/pickDate/lib/translations/id_ID.js') ?><!--"></script>-->
    <!--    <script src="--><?php //echo base_url('assets/pickDate/lib/legacy.js') ?><!--"></script>-->
    <script src="<?php echo base_url('assets/pickDate/lib/picker.js') ?>"></script>
    <script src="<?php echo base_url('assets/pickDate/lib/picker.date.js') ?>"></script>

    <!--    <script src="--><?php //echo base_url('assets/select/chosen.jquery.js') ?><!--"></script>-->
    <script src="<?php echo base_url('assets/select/chosen.jquery.min.js') ?>"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/UI/themes/eggplant/jquery-ui.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/pickDate/lib/themes/classic.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/pickDate/lib/themes/classic.date.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/select/chosen.min.css') ?>">
    <script>
        $(document).ready(function() {
            //JQUERY START

            function reset() {
                var n = new Date() ;
//                var pick = $('#datePick').pickadate(), pDate = pick.pickadate('picker') ;
                $('#klik').attr('data', 1) ;
                $('#nim').prop('readonly', false) ;
                $('#nim').val('') ;
                $('#nama').val('') ;
                var dt = new Date ;
                $('#datePick').pickadate('picker').set('select', dt) ;
                $('#agama').val(null).trigger('chosen:updated');
            }

            function valid() {
                var nim, nama, tgl, agama ;
                nim = $('#nim').val() ;
                nama = $('#nama').val() ;
                tgl = $('#datePick').val() ;
                agama = $('#agama').val() ;

                if (nim != '' && nama != '' && tgl != '' && agama != '') {
                    return true ;
                }
                else {
                    // alert('Data Belum Lengkap !!!') ;
                    var x = 'Data Belum Lengkap !!!' ;
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
                                    $(this).dialog("close") ;
                                    $('#show').load(window.location + ' #show') ;
                                    reset() ;
                                }
                            }
                        }) ;

                        $('#alert').html('<p align=center>'+x+'</p>') ;
                        $('#alert').dialog('open') ;
                    return false ;
                }
            }

            $('.del').click(function() {
                $.ajax({
                    type : 'POST',
                    url : "<?php echo base_url('Data/deleteData/') ?>" + $(this).attr('data'),
                    success : function (x) {
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
                                    $(this).dialog("close") ;
                                    $('#show').load(window.location + ' #show') ;
                                    reset() ;
                                }
                            }
                        }) ;

                        $('#alert').html('<p align=center>'+x+'</p>') ;
                        $('#alert').dialog('open') ;
                    }
                }) ;

                return false ;
            }) ;

            $('#datePick').pickadate({
                monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                weekdaysFull: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                firstDay: 1,
                format: 'dddd, dd mmmm yyyy',
                formatSubmit: 'yyyy-mm-dd',
                today: 'Hari Ini',
                clear: 'Hapus',
                close: 'Batal',
                hiddenSuffix: ''
            }) ;

            $('#agama').chosen({
                width: '100',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            $('#klik').click(function() {
                if (valid() == true) {
                    if  ($(this).attr('data') == 1) {
                       // alert($(this).attr('data')) ;
                       // return ;
                        //INSERT ACT------------------------------------------------------------------

                        $('#inputData').submit(function() {
                            $.ajax({
                                type : 'POST',
                                url : '<?php echo base_url().'Data/saveData'?>',
                                data : $('#inputData').serialize(),
                                success : function (x) {
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
                                                $('#show').load(window.location + ' #show') ;
                                                reset() ;
                                            }
                                        }
                                    }) ;

                                    $('#alert').html('<p align=center>'+x+'</p>') ;
                                    $('#alert').dialog('open') ;
                                }
                            }) ;

                            return false ;
                        }) ;

                        $('#inputData').submit() ;

                        //INSERT ACT END--------------------------------------------------------------
                    }
                    else if ($(this).attr('data') == 2) {
                       // alert($(this).attr('data')) ;
                       // return ;
                        //UPDATE ACT------------------------------------------------------------------

                        $('#inputData').submit(function() {
                            $.ajax({
                                type : 'POST',
                                url : '<?php echo base_url().'Data/updateData'?>',
                                data : $('#inputData').serialize(),
                                success : function (x) {
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
                                                $('#show').load(window.location + ' #show') ;
                                                reset() ;
                                            }
                                        }
                                    }) ;

                                    $('#alert').html('<p align=center>'+x+'</p>') ;
                                    $('#alert').dialog('open') ;
                                }
                            }) ;

                            return false ;
                        }) ;

                        $('#inputData').submit() ;

                        //UPDATE ACT END--------------------------------------------------------------
                    }
                }
            }) ;

            $('#nim').blur(function() {
                if ($(this).val() != '') {
                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('Data/indexData')?>',
                        data : {nim : $.trim($(this).val())},
                        dataType : 'json',
                        success : function(x) {
                            $('#klik').attr('data', 2) ;
                            $('#nim').prop('readonly', true) ;
                            $('#nim').val(x['nim']) ;
                            $('#nama').val(x['nama']) ;
                            // $('#datePick').attr('data-value', x['tgl_lahir']) ;
                            var dt = x['tgl_lahir'] ;
                            dt = new Date(dt) ;
                            $('#datePick').pickadate('picker').set('select', dt) ;
                            // $('#datePick').pickadate('set', 'view', x['tgl_lahir'], {format: 'dddd, dd mmmm yyyy'}) ;
                            $('#agama').val(x['religion']).trigger('chosen:updated');
                        }
                    }) ;
                }
            }) ;

            $('#reset').click(function() {
                reset() ;
            }) ;

            //JQUERY END
        }) ;
    </script>
</head>
<body>
<div id="alert">
</div>

<div id="form">
    <form name="inputData" id="inputData" method="POST">
        <table>
            <tr>
                <td><label for="txnim">NIM</label></td>
                <td>:</td>
                <td><input type="text" name="txnim" id="nim"></td>
            </tr>

            <tr>
                <td><label for="txnama">Nama</label></td>
                <td>:</td>
                <td><input type="text" name="txnama" id="nama"></td>
            </tr>

            <tr>
                <td><label for="date">Tanggal Lahir</label></td>
                <td>:</td>
                <td><input type="text" name="date" id="datePick" data-value="<?php echo date('y/m/d') ;?>"></td>
            </tr>

            <tr>
                <td><label for="agama">Agama</label></td>
                <td>:</td>
                <td>
                    <select name="agama" id="agama" data-placeholder="Silahkan Pilih Agama">
                        <option value="x" selected disabled style="display: none;">Silahkan Pilih Agama</option>
                        <?php
                        $agama = array('Islam','Kristen','Budha','Hindu','Katolik') ;
                        for ($a = 0; $a < 5; $a++) {
                            echo "<option value=$a>$agama[$a]</option>" ;
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="3" align="right"><input type="button" value="Reset" id="reset"> <input type="button" id="klik" data="1" name="proses" value="Done"></td>
            </tr>
        </table>
    </form>
</div>

<div id="show">
<?php
$bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] ;

$isi = count($mhs) ;
if ($isi < 1) {
    echo "<br><br><b>TIDAK ADA DATA SILAHKAN INPUT BARU</b>" ;
}
else {
    ?>

    <table border="1">
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
            echo "<td><a class='del' data='".$row->nim."' href=''>Hapus Data</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <!--    </div>-->
    <?php
}
?>
</div>
</body>
</html>