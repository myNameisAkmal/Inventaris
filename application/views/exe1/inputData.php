<html>
<head>
    <title>INPUT DATA MAHASISWA</title>
    <script src="<?php echo base_url('assets/JQuery.js') ?>"></script>
    <script src="<?php echo base_url('assets/UI/jquery-ui.min.js') ?>"></script>

<!--    <script src="--><?php //echo base_url('assets/pickDate/lib/translations/id_ID.js') ?><!--"></script>-->
<!--    <script src="--><?php //echo base_url('assets/pickDate/lib/legacy.js') ?><!--"></script>-->
    <script src="<?php echo base_url('assets/pickDate/lib/picker.js') ?>"></script>
    <script src="<?php echo base_url('assets/pickDate/lib/picker.date.js') ?>"></script>

<!--    <script src="--><?php //echo base_url('assets/select/chosen.jquery.js') ?><!--"></script>-->
    <script src="<?php echo base_url('assets/select/chosen.jquery.min.js') ?>"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/UI/themes/dark-hive/jquery-ui.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/pickDate/lib/themes/classic.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/pickDate/lib/themes/classic.date.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/select/chosen.min.css') ?>">

    <script>
        $(document).ready(function() {
            //JQUERY START

            $('#datePick').pickadate({
                monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                weekdaysFull: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                firstDay: 1,
                format: 'dddd, dd mmmm yyyy',
                formatSubmit: 'yyyy/mm/dd',
                today: 'Hari Ini',
                clear: 'Hapus',
                close: 'Batal',
                hiddenSuffix: ''
            }) ;

            $('#agama').chosen({
                width: '100',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

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
                        window.location.href = "<?php echo base_url('Data/getData')?>" ;
                    }
                }
            }) ;

            $('#inputData').submit(function() {
                $.ajax({
                    type : 'POST',
                    url : '<?php echo base_url().'Data/saveData'?>',
                    data : $('#inputData').serialize(),
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
<form name="inputData" id="inputData" method="POST">
    <table>
        <tr>
            <td><label for="txnim">NIM</label></td>
            <td>:</td>
            <td><input type="text" name="txnim"></td>
        </tr>

        <tr>
            <td><label for="txnama">Nama</label></td>
            <td>:</td>
            <td><input type="text" name="txnama"></td>
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
            <td colspan="3" align="right"><input type="submit" name="proses" value="Done"></td>
        </tr>
    </table>
</form>
</body>
</html>