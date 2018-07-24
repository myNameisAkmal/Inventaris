<html>
<head>
    <title>EDIT DATA MAHASISWA</title>
    <script src="<?php echo base_url('assets/JQuery.js') ?>"></script>
    <script src="<?php echo base_url('assets/UI/jquery-ui.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/pickDate/lib/translations/id_ID.js') ?>"></script>
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
                weekdaysFull: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                weekdaysShort: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                format: 'dddd, dd mmmm yyyy',
                formatSubmit: 'yyyy/mm/dd',
                today: 'Hari Ini',
                clear: 'Hapus',
                close: 'Batal',
                hiddenSuffix: ''
            }) ;

            $('#agama').chosen({
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            //JQUERY END
        }) ;
    </script>
</head>
<body>

<form name="editData" method="POST" action="<?php echo base_url().'Data/updateData'?>">
    <table>
        <tr>
            <td><label for="txnim">NIM</label></td>
            <td>:</td>
            <td><input type="text" name="txnim" value="<?php echo $nim ?>" readonly></td>
        </tr>

        <tr>
            <td><label for="txnama">Nama</label></td>
            <td>:</td>
            <td><input type="text" name="txnama" value="<?php echo $nama ?>"></td>
        </tr>

        <tr>
            <td><label for="date">Tanggal Lahir</label></td>
            <td>:</td>
            <td><input type="text" name="date" id="datePick" data-value="<?php echo $tgl_lahir ?>"></td>
        </tr>

        <tr>
            <td><label for="agama">Agama</label></td>
            <td>:</td>
            <td>
                <select name="agama" id="agama">
                    <?php
                    $agama = array('Islam','Kristen','Budha','Hindu','Katolik') ;
                    for ($a = 0; $a < 5; $a++) {
                        if ($a == $religion) {
                            $c = "selected" ;
                        }
                        else {
                            $c = "" ;
                        }
                        echo "<option value=$a $c>$agama[$a]</option>" ;
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