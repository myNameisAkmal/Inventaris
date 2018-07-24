<style>
    #tblData {
        font-family: "Helvetica Neue";
    }
    #tblData_info {
        font-family: "Helvetica Neue";
        font-size: 14px;
        text-align: left;
    }
    #tblData_filter {
        font-family: "Helvetica Neue";
        font-size: 14px;
    }
    .table > tbody > tr > td {
        vertical-align: middle;
        text-align: center;
        font-size: 14px;
    }
    .table > thead > tr > th {
        text-align: center;
        font-size: 17px;
        font-family: "Helvetica Neue";
    }
    .table > tbody > tr {
        font-size: 15px;
    }
    .table > thead > tr {
        font-size: 20px;
    }
    label {
        vertical-align: middle;
    }
    select.form-control + .chosen-container .chosen-search input[type=text] {
        color: black;
    }
    select.form-control + .chosen-container.chosen-container-single .chosen-single {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555;
        vertical-align: middle;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        background-image:none;
    }
    label.btn{
        margin-top: 0px;
    }
    div.dt-buttons {
      position: relative;
      float: left;
    }
    </style>

<script>
    //START
    $(document).ready(function() {
            //JQUERY START
            var temp_nim ;
            // var tblData = $('#tblData').DataTable();

            // function getData() {
            //     $.getJSON("<?php echo base_url('CTemplate/getData') ?>", function(x) {
            //         // console.log(x); return false;
                    
            //         var data = "" ;
            //         var base = "<?php echo base_url('assets/images/') ?>" ;
            //         $('#tblData tbody').empty();
            //         $.each(x, function(n, val){
            //             var date = new Date(val.tgl_lahir) ;
            //             // console.log(date); return false;
            //             data = data + "<tr>" ;
            //             data = data + "<td>"+(n + 1)+"</td>" ;
            //             data = data + "<td>"+val.nim+"</td>" ;
            //             data = data + "<td>"+val.nama+"</td>" ;
            //             data = data + "<td>"+ date.toLocaleString("id-id", {day: "numeric", month: "long", year: "numeric"}) +"</td>";
            //             data = data + "<td>"+val.agama+"</td>";
            //             data = data + "<td><img src='"+base+val.foto+"' height='80px' width='80px'></td>";
            //             data = data + "<td>" ;
            //             data = data + "<button type='button' class='btn btn-warning edt' style='border-radius:10px' data='"+val.nim+"'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button>" ;
            //             data = data + "<button type='button' class='btn btn-danger del' style='border-radius:10px' data='"+val.nim+"'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</button>" ;
            //             data = data + "</td>" ;
            //             data = data + "</tr>";
            //         }) ;
            //         $('#tblData tbody').append(data);
            //     }) ;
            // }

            $('#modal .close').click(function() {
                reset(1);
            }) ;

            var table ;
            table = $('#tblData').DataTable({
                dom: "Bfrtip",
                responsive: true,
                select: true,
                filter: true,
                paging: true,
                pageLength: 5,
                serverSide: false,
                processing: false,
                buttons: [
                    {text: " Add", className: "btn btn-primary fa fa-plus", enabled: true,
                    action: function() {
                        $('#modalTitle').html('Tambah Data');
                        $('#modal').modal("show");
                        $('#save').attr('data', 1);
                        getJur() ;
                        // console.log($('#inputData')[0]);
                    }},
                    {text: " Edit", className: "btn btn-warning fa fa-pencil", enabled: true,
                    action: function() {
                        var row = table.rows('.selected').indexes();
                        if (row.length < 1) {
                            swal("Information", "Silahkan Pilih Data Yang Ingin Di Edit", "info") ;
                            return ;
                        }

                        var data = table.rows(row).data();
                        var nim = data[0].nim ;
                        // console.log(nim); return false;
                        temp_nim = nim ;
                        loadData(nim) ;
                        $('#modalTitle').html('Update Data');
                        $('#modal').modal("show");
                        $('#save').html("Update");
                        $('#save').attr('data', 2);
                        // console.log($('#inputData')[0]);
                    }},
                    {text: " Delete", className: "btn btn-danger fa fa-trash-o", enabled: true,
                    action: function() {
                        var row = table.rows('.selected').indexes();
                        if (row.length < 1) {
                            swal("Information", "Silahkan Pilih Data Yang Ingin Di Hapus", "info") ;
                            return ;
                        }
                        else {
                            var data = table.rows(row).data();
                            var nim = data[0].nim ;
                            var nama = data[0].nama ;
                            swal({
                                title: 'Warning',
                                text: 'Data '+nama+' ('+nim+') Akan Dihapus?',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Hapus!'
                                }).then(function() {
                                    $.ajax({
                                        type : 'POST',
                                        url : "<?php echo base_url('Data/deleteData/') ?>" + nim,
                                        success : function(x) {
                                            swal("Ok", x, "success", false).then(function() {
                                                // window.location.reload();
                                                table.ajax.reload(null, true);
                                            }) ;
                                        }
                                    }) ;
                                }) ;
                        }
                    }}
                ],
                ajax: {
                    url: "<?php echo base_url('CTemplate/getData') ?>",
                    dataSrc: "mhs"
                },
                columns: [
                    {render: function(data, type, row, meta) {
                        // console.log(data);
                        // console.log(type);
                        // console.log(row);
                        // console.log(meta);
                        // return false;
                        return meta.row + 1 ;
                    }},
                    {data: "nim", name: "nim"},
                    {data: "nama", name: "nama"},
                    {data: "tgl_lahir", name: "tgl_lahir", render: function(data, type, row, meta){
                        var date = new Date(data) ;
                        // console.log(row) ; return false;
                        return row.tempat + ", " + date.toLocaleString("id-id", {day: "numeric", month: "long", year: "numeric"})
                    }, sortable: false},
                    {data: "agama", name: "agama", sortable: false},
                    {data: "jurusan", name: "jurusan", render: function(data, type, row, meta) {
                        return data + "<br>" + row.kelas ;
                    }, sortable: false},
                    {data: "foto", name: "foto", render: function(data, type, row){
                        var foto = "<?php echo base_url('assets/images/') ?>"+data ;

                        return "<img src='"+foto+"' height='80px' width='80px' />" ;
                    }, sortable: false}
                ],
                language: {
                    search: "Temukan: ",
                    searchPlaceholder: " NIM atau Nama"
                }

            });

            // $('#add').click(function() {
            //     $('#modalTitle').html('Tambah Data');
            //     $('#modal').modal("show");
            //     $('#save').html("Save");
            //     $('#save').attr('data', 1);
            // }) ;

            function readURL(input) {

                if (input.files && input.files[0])
                {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#fotobox').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);

                }
            }

            $('#agama').chosen({
                width: '100%',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            $('#jurusan').chosen({
                width: '100%',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            $('#kelas').chosen({
                width: '100%',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            $('#fileFoto').filestyle({
                text: " Cari Foto",
                btnClass: "btn-success"
                // buttonName: "btn-warning",
            }) ;

            $('#fileFoto').change(function() {
                // console.log($(this)[0].files[0].name) ; return false ;
                $('#tempelFoto').val($(this).val()) ;
                $('#fotobox').attr('style', 'display: block') ;
                readURL(this) ;
            }) ;

            function reset(x) {
                if(x == 1) {
                    var n = new Date() ;
    //                var pick = $('#datePick').pickadate(), pDate = pick.pickadate('picker') ;
                    $('#save').html('Save') ;
                    $('#nim').prop('readonly', false) ;
                    $('#nim').val('') ;
                    $('#nama').val('') ;
                    $('#tempat').val('') ;
                    var dt = new Date ;
                    $('#datePick').pickadate('picker').set('select', dt) ;
                    $('#agama').val('x').trigger('chosen:updated');
                    $('#jurusan').val('x').trigger('chosen:updated');
                    $('#kelas').empty();
                    $('#kelas').attr('disabled', true);
                    $('#kelas').append("<option value='x' selected>Pilih Jurusan Terlebih Dahulu</option>") ;
                    $('#kelas').trigger("chosen:updated");
                    $('#fileFoto').filestyle('clear') ;
                    $('#fileFoto').filestyle('placeholder', '') ;
                    // $('#foto').replaceWith($('#foto').val('').clone(true));
                    $('#tempelFoto').val('') ;
                    $('#fotobox').attr('style', 'display: none') ;
                    $('#fotobox').attr('src', '') ;
                    // alert('1');
                }
                else {
                    loadData(temp_nim) ;
                }
            }

    //         function reset2() {
    //             if($('#save').attr('data') == 2) {
    //                 var n = new Date() ;
    // //                var pick = $('#datePick').pickadate(), pDate = pick.pickadate('picker') ;
    //                 $('#save').html('Save') ;
    //                 $('#nim').prop('readonly', false) ;
    //                 $('#nim').val('') ;
    //                 $('#nama').val('') ;
    //                 $('#tempat').val('') ;
    //                 var dt = new Date ;
    //                 $('#datePick').pickadate('picker').set('select', dt) ;
    //                 $('#agama').val('x').trigger('chosen:updated');
    //                 $('#fileFoto').fileStyle('clear') ;
    //                 // $('#foto').replaceWith($('#foto').val('').clone(true));
    //                 $('#tempelFoto').val('') ;
    //                 $('#fotobox').attr('style', 'display: none') ;
    //                 $('#fotobox').attr('src', '') ;
    //                 alert('2');
    //             }
    //             else {
    //                 loadData(temp_nim) ;
    //             }
    //         }

            function valid() {
                var nim, nama, tgl, agama ;
                nim = $('#nim').val() ;
                nama = $('#nama').val() ;
                tgl = $('#datePick').val() ;
                agama = $('#agama').val() ;
                tmp = $('#tempat').val() ;
                jur = $('#jurusan').val();
                kel = $('#kelas').val();
                // console.log(agama); return false;

                if (nim != '' && nama != '' && tgl != '' && agama != null && tmp != '' && jur != null && kel != null) {
                    return true ;
                }
                else {
                    // alert('Data Belum Lengkap !!!') ;
                    swal('Oops!!!','Data Belum Lengkap','error') ;
                    return false ;
                }
            }

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

            // $('.del').click(function() {
            //     // alert('hahahah');
            //     var id = $(this).attr('data') ;
            //     swal({
            //         title: 'Data '+id+' Akan Dihapus?',
            //         // text: "Proses Delete Tidak Bisa Dicancel!!",
            //         type: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Hapus!'
            //         }).then(function() {
            //             $.ajax({
            //                 type : 'POST',
            //                 url : "<?php echo base_url('Data/deleteData/') ?>" + id,
            //                 success : function(x) {
            //                     swal("Ok", x, "success", false).then(function() {
            //                         window.location.reload();
            //                     }) ;
            //                 }
            //             }) ;
            //         }) ;
            // }) ;

            // $(".edt").click(function() {
            //     var id = $(this).attr('data') ;
            //     temp_nim = id ;
            //     loadData(id) ;
            //     $('#modalTitle').html('Update Data');
            //     $('#modal').modal("show");
            //     $('#save').html("Update");
            //     $('#save').attr('data', 2);
            // }) ;

            $('#save').click(function() {
                var val = $(this).attr('data');
                if (valid() == true) {
                    if  (val == 1) {
                        //INSERT ACT------------------------------------------------------------------
                        var x = new FormData($('#inputData')[0]) ;
                        // console.log(x);return false;
                        $.ajax({
                            url : "<?php echo base_url('Data/saveData') ?>",
                            type : "POST",
                            data : x,
                            processData : false,
                            contentType : false,
                            cache : false,
                            async : false,
                            dataType : "JSON",
                            success : function(x) {
                                if(x.sts == "v") {
                                    swal("Ok", x.msg, "success", false).then(function() {
                                        reset(val);
                                        // window.location.reload() ;
                                        $('#modal').modal("hide") ;
                                        // $('#inputData')[0].reset();
                                        table.ajax.reload(null, true);
                                    }) ;
                                }
                                else {
                                    swal("Sorry", x.msg, "error", false) ;
                                }
                            }
                        }) ;

                        //INSERT ACT END--------------------------------------------------------------
                    }
                    else if (val == 2) {
                       // alert($(this).attr('data')) ;
                       // return ;
                        //UPDATE ACT------------------------------------------------------------------

                        var x = new FormData($('#inputData')[0]) ;
                        // console.log(x) ;
                        $.ajax({
                            url : "<?php echo base_url('Data/updateData') ?>",
                            type : "POST",
                            data : x,
                            processData : false,
                            contentType : false,
                            cache : false,
                            async : false,
                            dataType : "JSON",
                            success : function(x) {
                                if(x.sts == "v") {
                                    swal("Ok", x.msg, "success", false).then(function() {
                                        reset(1);
                                        // window.location.reload() ;
                                        $('#modal').modal("hide") ;
                                        // $('#inputData')[0].reset();
                                        table.ajax.reload(null, true);
                                    }) ;
                                }
                                else {
                                    swal("Sorry", x.msg, "error", false) ;
                                }
                            }
                        }) ;

                        //UPDATE ACT END--------------------------------------------------------------
                    }
                }
            }) ;

            $('#reset').click(function() {
                var x = $('#save').attr('data');
                reset(x);
            }) ;

            function loadData(id) {
                $.ajax({
                    type : 'POST',
                    url : '<?php echo base_url('Data/indexData')?>',
                    data : {nim : id},
                    dataType : 'json',
                    success : function(x) {
                        $('#nim').prop('readonly', true) ;
                        $('#nim').val(x['nim']) ;
                        $('#nama').val(x['nama']) ;
                        $('#tempat').val(x['tempat']) ;
                        // $('#datePick').attr('data-value', x['tgl_lahir']) ;
                        var dt = x['tgl_lahir'] ;
                        dt = new Date(dt) ;
                        $('#datePick').pickadate('picker').set('select', dt) ;
                        // $('#datePick').pickadate('set', 'view', x['tgl_lahir'], {format: 'dddd, dd mmmm yyyy'}) ;
                        $('#agama').val(x['religion']).trigger('chosen:updated');
                        getJur(x['jurusan']) ;
                        getKel(x['jurusan'],x['kelas']) ;
                        if (x['foto'] != '' && x['foto'] != 'noPict.jpg') {
                            $('#fileFoto').filestyle('placeholder', x['foto']) ;
                            $('#tempelFoto').val(x['foto']) ;
                            $('#fotobox').attr('style','').attr('src',"<?php echo base_url('assets/images/') ?>"+x['foto']);
                        }
                    }
                }) ;
            }

            $('#jurusan').change(function() {
                var ini = $(this).val() ;
                getKel(ini, '');
            }) ;

            function getJur(par = "") {
                var ex = '' ;
                $.getJSON("<?php echo base_url('CTemplate/getJurusan') ?>", function(data) {
                    $('#jurusan').empty() ;
                    $("#jurusan").append("<option value='x' selected disabled style='display: none'>Silahkan Pilih Jurusan</option>") ;
                    $.each(data, function(key, val) {
                        // console.log(val.kd_jurusan);
                        ex = '' ;
                        if (par != "") {
                            if (val.kd_jurusan == par) {
                                ex = 'selected' ;
                            }
                            // else {
                            //     ex = '' ;
                            // }
                        }
                        $("#jurusan").append("<option value='"+val.kd_jurusan+"' "+ex+">"+val.nm_jurusan+"</option>") ;
                    }) ;
                    $('#jurusan').trigger("chosen:updated");
                }) ;
            }

            function getKel(sub = "", par = "") {
                var ex = '' ;
                if (sub != null) {
                    $.getJSON("<?php echo base_url('CTemplate/getKelas/') ?>"+sub, function(data) {
                        $('#kelas').empty() ;
                        $('#kelas').attr('disabled', false) ;
                        $("#kelas").append("<option value='x' selected disabled style='display: none'>Silahkan Pilih Kelas</option>") ;
                        $.each(data, function(key, val) {
                            // console.log(data);
                            ex = '' ;
                            if (par != "") {
                                if (val.kd_kelas == par) {
                                    ex = 'selected' ;
                                }
                                // else {
                                //     ex = '' ;
                                // }
                            }
                            if (sub == 'KA') {
                                ex = 'selected' ;
                            }
                            $("#kelas").append("<option value='"+val.kd_kelas+"' "+ex+">"+val.nm_kelas+"</option>") ;
                        }) ;
                        $('#kelas').trigger("chosen:updated");
                    }) ;
                }
            }

            // $('#nim').blur(function() {
            //     if ($(this).val() != '') {
            //         $.ajax({
            //             type : 'POST',
            //             url : '<?php echo base_url('Data/indexData')?>',
            //             data : {nim : $.trim($(this).val())},
            //             dataType : 'json',
            //             success : function(x) {
            //                 $('#klik').attr('data', 2) ;
            //                 $('#nim').prop('readonly', true) ;
            //                 $('#nim').val(x['nim']) ;
            //                 $('#nama').val(x['nama']) ;
            //                 // $('#datePick').attr('data-value', x['tgl_lahir']) ;
            //                 var dt = x['tgl_lahir'] ;
            //                 dt = new Date(dt) ;
            //                 $('#datePick').pickadate('picker').set('select', dt) ;
            //                 // $('#datePick').pickadate('set', 'view', x['tgl_lahir'], {format: 'dddd, dd mmmm yyyy'}) ;
            //                 $('#agama').val(x['religion']).trigger('chosen:updated');
            //             }
            //         }) ;
            //     }
            // }) ;            

            //JQUERY END
        }) ;
    //END

    // JQUERY

</script>

<table id="tblData" class="table table-responsive" width="100%">
    <thead>
    <tr>
        <!-- <th width="50px">No</th>
        <th width="100px">NIM</th>
        <th>Nama</th>
        <th width="150px">Tanggal Lahir</th>
        <th width="100px">Agama</th>
        <th>Foto</th>
        <th width="225px">Action</th> -->
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Tempat, Tanggal Lahir</th>
        <th>Agama</th>
        <th>Jurusan<br>Kelas</th>
        <!-- <th>Agama</th> -->
        <th>Foto</th>
    </tr>
    </thead>

    <tbody>
    <?php
        // foreach ($mhs as $row => $val) {
        //     $date = new DateTime($val->tgl_lahir) ;

        //     echo "<tr>";
        //     echo "<td>".($row + 1)."</td>";
        //     echo "<td>$val->nim</td>";
        //     echo "<td>$val->nama</td>";
        //     echo "<td>".$date->format('d')." ".$bulan[(int)$date->format('m')]." ".$date->format('Y')."</td>";
        //     echo "<td>$val->agama</td>";
        //     echo "<td><img src='".base_url('assets/images/'.$val->foto)."' height='80px' width='80px'></td>";
        //     echo "<td>
        //     <button type='button' class='btn btn-warning edt' style='border-radius:10px' data='".$val->nim."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button> 
        //     <button type='button' class='btn btn-danger del' style='border-radius:10px' data='".$val->nim."'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</button>
        //     </td>";
        //     echo "</tr>";
        // }
    ?>
    </tbody>
</table>
<!-- </div> -->

<!-- Modalss -->
<div id="modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
<div id="modalDialog" class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <h5 class="modal-title" id="modalTitle"></h5>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
        <form name="inputData" id="inputData" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-3" for="nim">NIM :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[nim]" id="nim">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="nama">Nama Mahasiswa :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[nama]" id="nama">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="tempat">Tempat Lahir :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[tempat]" id="tempat">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="datePick">Tanggal Lahir :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[tgl_lahir]" id="datePick" data-value="<?php echo date('y/m/d') ;?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="agama">Agama :</label>
                <div class="col-sm-8">
                    <select name="data[agama]" id="agama" class="form-control">
                        <option value="x" selected disabled style="display: none;">Silahkan Pilih Agama</option>
                        <?php
                            $agama = array('Islam','Kristen','Budha','Hindu','Katolik') ;
                            for ($a = 0; $a < 5; $a++) {
                                echo "<option value=$a>$agama[$a]</option>" ;
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="jurusan">Jurusan :</label>
                <div class="col-sm-8">
                    <select name="data[jurusan]" id="jurusan" class="form-control">
                        
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="kelas">Kelas :</label>
                <div class="col-sm-8">
                    <select name="data[kelas]" id="kelas" class="form-control" disabled="true">
                        <option value="x" selected>Pilih Jurusan Terlebih Dahulu</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="fileFoto" class="control-label col-sm-3">Foto :</label>
                <div class="col-sm-8">
                    <input id="fileFoto" name="fileFoto" type="file" accept="image/*">
                    <input type="hidden" name="tempelFoto" id="tempelFoto">
                    <img id="fotobox" src="" alt="Foto Anda.." align="left" style="display: none" width="100" height="100">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    <button type="button" class="btn btn-warning form-control" id="reset">Reset</button>
                </div>

                <div class="col-sm-3">
                    <button type="button" class="btn btn-info form-control" id="save" data="">Save</button>
                </div>
            </div>
        </form>
        </div>
        <!-- END Modal Body -->
    </div>

</div>
</div>
<!-- End Modals -->