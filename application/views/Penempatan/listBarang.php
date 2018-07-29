<style>
    #tblModal > tbody > tr > td {
        vertical-align: middle;
        text-align: right;
        font-size: 14px;
    }

    .container > .row > .col-sm-6 {
        position: relative;
        min-height: 1px;
        padding-left: 0px !important;
        padding-right: 15px;
    }
    .container > .row > .col-sm-6 > .col-sm-3 {
        /* position: relative;
        min-height: 1px; */
        padding-left: 0px !important;
        /* padding-right: 15px; */
    }
</style>
<script>
    //START
    var allDt ;
    var filter = {
        lok : null,
        lant : null,
        kat : null
    };
    var filterData = null;
    $(document).ready(function() {
            //JQUERY START
            var temp_id ;

            getLok('');
            getKat('');

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
                    // {text: " Input Penempatan Barang ", className: "btn btn-primary", enabled: true,
                    // action: function() {
                    //     $('#modalTitle').html('Tambah Data');
                    //     $('#modal').modal("show");
                    //     $('#save').attr('data', 1);
                    //     // reset(1);
                    //     getKat();
                    //     // console.log($('#inputData')[0]);
                    // }},
                    // {className: "btn btn-warning fa fa-pencil", enabled: true,
                    // action: function() {
                    //     var row = table.rows('.selected').indexes();
                    //     if (row.length < 1) {
                    //         swal("Information", "Silahkan Pilih Data Yang Ingin Di Edit", "info") ;
                    //         return ;
                    //     }

                    //     var data = table.rows(row).data();
                    //     var idB = data[0].id_barang ;
                    //     // console.log(nim); return false;
                    //     temp_id = idB ;
                    //     loadData(idB) ;
                    //     $('#modalTitle').html('Update Data');
                    //     $('#modal').modal("show");
                    //     $('#save').html("Update");
                    //     $('#save').attr('data', 2);
                    //     // console.log($('#inputData')[0]);
                    // }},
                    // {className: "btn btn-danger fa fa-trash-o", enabled: true,
                    // action: function() {
                    //     var row = table.rows('.selected').indexes();
                    //     if (row.length < 1) {
                    //         swal("Information", "Silahkan Pilih Data Yang Ingin Di Hapus", "info") ;
                    //         return ;
                    //     }
                    //     else {
                    //         var data = table.rows(row).data();
                    //         var idB = data[0].id_barang ;
                    //         var nama = data[0].nama_barang ;
                    //         swal({
                    //             title: 'Warning',
                    //             text: 'Data '+nama+' ('+idB+') Akan Dihapus?',
                    //             type: 'warning',
                    //             showCancelButton: true,
                    //             confirmButtonColor: '#d33',
                    //             cancelButtonColor: '#3085d6',
                    //             confirmButtonText: 'Hapus!'
                    //             }).then(function() {
                    //                 $.ajax({
                    //                     type : 'POST',
                    //                     url : "<?php echo base_url('Invent/delete/') ?>",
                    //                     dataType : 'JSON',
                    //                     data : {id : idB},
                    //                     success : function(x) {
                    //                         if(!x.err){
                    //                             swal("Ok", x.msg, "success", false).then(function() {
                    //                                 // window.location.reload();
                    //                                 table.ajax.reload(null, true);
                    //                             }) ;
                    //                         }
                    //                         else {
                    //                             swal("Sorry", x.msg, "error", false) ;
                    //                         }
                    //                     }
                    //                 }) ;
                    //             }) ;
                    //     }
                    // }}
                ],
                ajax: {
                    url: "<?php echo base_url('Inventaris/getData') ?>",
                    dataSrc: function(json){
                        // console.log(json);
                        if(!filterData){
                            return json.inv;
                        }
                        else {
                            return filterData;
                        }
                    }
                },
                initComplete : function(settings, json){
                    // alert('Complete');
                    // console.log(settings);
                    // console.log(json);
                    allDt = json;
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
                    {data: "nama_lokasi", name: "nama_lokasi", sortable : false, render: function(data, type, row, meta) {
                        return row.nama_lokasi + "<br> Lantai " + row.lantai + "<br>" + row.id_ruang ;
                    }},
                    {data: "nama_barang", name: "nama_barang", render: function(data, type, row, meta) {
                        return row.nama_barang + "<br> (" + row.nama_kategori + ")" ;
                    }},
                    {data: "qty", name: "qty", render: function(data, type, row, meta) {
                        return row.qty + " " + row.satuan_barang ;
                    }},
                    {data: "expired", name: "expired", sortable : false, render: function(data, type, row, meta) {
                        var dt = row.expired;
                        var dts = dt.substr(8,2) + "-" + dt.substr(5,2) + "-" + dt.substr(0,4);
                        return dts ;
                    }},
                    // {data: "stock", name: "stock", sortable : false},
                    // {data: "satuan_barang", name: "satuan_barang", sortable : false},
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search Here"
                }

            });

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

            $('#skat').chosen({
                width: '200px',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            $("#skat").change(function(){
                var dt = $(this).val();

                if(dt != 'x'){
                    // filter = $.grep(allDt.inv, function(item){
                    //     return item.id_kategori.toLowerCase().indexOf(dt.toLowerCase()) > -1;
                    // });
                    filter.kat = dt;

                    // console.log(filter);
                }
                else {
                    filter.kat = null;
                }
            });

            $('#slok').chosen({
                width: '200px',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            $("#slok").change(function(){
                var dtLok = $(this).val();

                if(dtLok != 'x'){
                    // console.log(allDt.inv);
                    // filter = $.grep(allDt.inv, function(item){
                    //     return item.id_lokasi.toLowerCase().indexOf(dtLok.toLowerCase()) > -1;
                    // });
                    // console.log(filter);
                    filter.lok = dtLok;
                    getLantai('',dtLok);
                }
                else {
                    filter.lok = null;
                }
            });

            $('#slant').chosen({
                width: '200px',
                no_results_text: "Data Tidak Ada Untuk : "
            }) ;

            $("#slant").change(function(){
                var dt = $(this).val();

                if(dt != 'x'){
                    // filter = $.grep(allDt.inv, function(item){
                    //     return item.lantai.toLowerCase().indexOf(dt.toLowerCase()) > -1;
                    // });
                    // console.log(filter);
                    filter.lant = dt;
                }
                else {
                    filter.lant = null;
                }
            });

            function reset(x) {
                if(x == 1) {
                    var n = new Date() ;
                    //var pick = $('#datePick').pickadate(), pDate = pick.pickadate('picker') ;
                    $('#save').html('Save') ;
                    $('#id_barang').prop('readonly', false) ;
                    $('#id_barang').val('') ;
                    $('#nama').val('') ;
                    $('#satuan').val('') ;
                    $('#stock').val('') ;
                    $('#batas').val('') ;
                    // var dt = new Date ;
                    // $('#datePick').pickadate('picker').set('select', dt) ;
                    $('#kategori').val('x').trigger('chosen:updated');
                    // $('#kelas').empty();
                    // $('#kelas').attr('disabled', true);
                    // $('#kelas').append("<option value='x' selected>Pilih Jurusan Terlebih Dahulu</option>") ;
                    // $('#kelas').trigger("chosen:updated");
                    // $('#fileFoto').filestyle('clear') ;
                    // $('#fileFoto').filestyle('placeholder', '') ;
                    // $('#foto').replaceWith($('#foto').val('').clone(true));
                    // $('#tempelFoto').val('') ;
                    // $('#fotobox').attr('style', 'display: none') ;
                    // $('#fotobox').attr('src', '') ;
                    // alert('1');
                }
                else {
                    loadData(temp_id) ;
                }
            }

            function valid() {
                var id = $('#id_barang').val() ;
                var nama = $('#nama').val() ;
                var kat = $('#kategori').val() ;
                var satuan = $('#satuan').val() ;
                var stock = $('#stock').val() ;
                var bts = $('#batas').val() ;

                if (id != '' && nama != '' && kat != 'x' && satuan != '' && satuan != '' && stock != '' && bts != '') {
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

            $('#save').click(function() {
                var val = $(this).attr('data');
                // console.log(val);
                if (valid() == true) {
                    if  (val == 1) {
                        //INSERT ACT------------------------------------------------------------------
                        var x = new FormData($('#inputData')[0]) ;
                        console.log(x);
                        $.ajax({
                            url : "<?php echo base_url('Invent/save') ?>",
                            type : "POST",
                            data : x,
                            processData : false,
                            contentType : false,
                            cache : false,
                            async : false,
                            dataType : "JSON",
                            success : function(x) {
                                if(!x.err) {
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
                            url : "<?php echo base_url('Invent/update') ?>",
                            type : "POST",
                            data : x,
                            processData : false,
                            contentType : false,
                            cache : false,
                            async : false,
                            dataType : "JSON",
                            success : function(x) {
                                if(!x.err) {
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
            
            //get Search
            function loadData(id) {
                $.ajax({
                    type : 'POST',
                    url : '<?php echo base_url('Invent/getData')?>',
                    data : {id : id},
                    dataType : 'json',
                    success : function(x) {
                        // console.log(x);
                        x = x.inv[0];
                        $('#id_barang').prop('readonly', true) ;
                        $('#id_barang').val(x.id_barang) ;
                        $('#nama').val(x.nama_barang) ;
                        $('#satuan').val(x.satuan_barang) ;
                        $('#batas').val(x.batas_usia) ;
                        $('#stock').val(x.stock) ;
                        // $('#datePick').attr('data-value', x['tgl_lahir']) ;
                        // var dt = x['tgl_lahir'] ;
                        // dt = new Date(dt) ;
                        // $('#datePick').pickadate('picker').set('select', dt) ;
                        // $('#datePick').pickadate('set', 'view', x['tgl_lahir'], {format: 'dddd, dd mmmm yyyy'}) ;
                        // $('#agama').val(x['religion']).trigger('chosen:updated');
                        getKat(x.id_kategori) ;
                        // if (x['foto'] != '' && x['foto'] != 'noPict.jpg') {
                        //     $('#fileFoto').filestyle('placeholder', x['foto']) ;
                        //     $('#tempelFoto').val(x['foto']) ;
                        //     $('#fotobox').attr('style','').attr('src',"<?php echo base_url('assets/images/') ?>"+x['foto']);
                        // }
                    }
                }) ;
            }

            function getLok(par = "") {
                var ex = '' ;
                $.getJSON("<?php echo base_url('Inventaris/getLokasi') ?>", function(data) {
                    $('#slok').empty() ;
                    $("#slok").append("<option value='x' selected>Pilih Semua Lokasi</option>") ;
                    $.each(data, function(key, val) {
                        // console.log(val.kd_jurusan);
                        ex = '' ;
                        if (par != "") {
                            if (val.id_lokasi == par) {
                                ex = 'selected' ;
                            }
                            // else {
                            //     ex = '' ;
                            // }
                        }
                        $("#slok").append("<option value='"+val.id_lokasi+"' "+ex+">"+val.nama_lokasi+"</option>") ;
                    }) ;
                    $('#slok').trigger("chosen:updated");
                }) ;
            }

            function getLantai(par = "", lok = "") {
                var ex = '' ;
                $.getJSON("<?php echo base_url('Inventaris/getLantai/') ?>"+lok, function(data) {
                    $('#slant').empty() ;
                    $('#slant').removeAttr('disabled');
                    $("#slant").append("<option value='x' selected>Pilih Semua Lantai</option>") ;
                    $.each(data, function(key, val) {
                        // console.log(val.kd_jurusan);
                        ex = '' ;
                        if (par != "") {
                            if (val.lantai == par) {
                                ex = 'selected' ;
                            }
                            // else {
                            //     ex = '' ;
                            // }
                        }
                        $("#slant").append("<option value='"+val.lantai+"' "+ex+">Lantai "+val.lantai+"</option>") ;
                    }) ;
                    $('#slant').trigger("chosen:updated");
                }) ;
            }

            function getKat(par = "") {
                var ex = '' ;
                $.getJSON("<?php echo base_url('Inventaris/getKategori') ?>", function(data) {
                    $('#skat').empty() ;
                    $("#skat").append("<option value='x' selected>Pilih Semua Kategori</option>") ;
                    $.each(data, function(key, val) {
                        // console.log(val.kd_jurusan);
                        ex = '' ;
                        if (par != "") {
                            if (val.id_kategori == par) {
                                ex = 'selected' ;
                            }
                            // else {
                            //     ex = '' ;
                            // }
                        }
                        $("#skat").append("<option value='"+val.id_kategori+"' "+ex+">"+val.nama_kategori+"</option>") ;
                    }) ;
                    $('#skat').trigger("chosen:updated");
                }) ;
            }
            //end get Search
            
            function resetSearch() {
                getLok('');
                $("#slant").empty();
                $("#slant").append('<option value="" style="display:none">Pilih Lokasi Terlebih Dahulu</option>');
                $('#slant').trigger("chosen:updated");
                getKat('');
            }

            $("#sReset").click(function(){
                // $("#slant").empty();
                // $("#slant").append('<option value="" style="display:none">Pilih Lokasi Terlebih Dahulu</option>');
                resetSearch();
                filter.lok = null;
                filter.lant = null;
                filter.kat = null;
            });

            $("#sSearch").click(function(){
                var dtFilt = allDt.inv;
                // console.log(filter);
                if(!filter.lok && !filter.lant && !filter.kat){
                    filterData = null;
                }
                else {
                    if(filter.lok || filter.lant || filter.kat){
                        if(filter.lok){
                            if(filter.lok != '' || filter.lok != 'x'){
                                dtFilt = $.grep(dtFilt, function(item){
                                    return item.id_lokasi.toLowerCase().indexOf(filter.lok.toLowerCase()) > -1;
                                });
                            }
                            // else if(filter.lok = 'x'){
                            //     dtFilt = null;
                            // }
                        }
                        if(filter.lant){
                            if(filter.lant != '' || filter.lant != 'x'){
                                dtFilt = $.grep(dtFilt, function(item){
                                    return item.lantai.toLowerCase().indexOf(filter.lant.toLowerCase()) > -1;
                                });
                            }
                            // else if(filter.lant = 'x'){
                            //     dtFilt = null;
                            // }
                        }
                        if(filter.kat){
                            if(filter.kat != '' || filter.kat != 'x'){
                                dtFilt = $.grep(dtFilt, function(item){
                                    return item.id_kategori.toLowerCase().indexOf(filter.kat.toLowerCase()) > -1;
                                });
                            }
                            // else if(filter.kat = 'x'){
                            //     console.log(filter.kat);
                            //     dtFilt = null;
                            // }
                        }
                    }
                }

                // console.log(table);
                // table.data(JSON.stringify(dtFilt));
                filterData = dtFilt;
                table.ajax.reload();
            });
            //JQUERY END
    }) ;

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    //END

    // JQUERY

</script>

<div class="container">
    <div class="row">
        <div class="col-sm-6" style="width:72%">
            <div class="col-sm-3">
                <select name="slok" id="slok" class="form-control">
                </select>
            </div>
            <div class="col-sm-3">
                <select name="slant" id="slant" class="form-control">
                    <option value="" style="display:none">Pilih Lokasi Terlebih Dahulu</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="skat" id="skat" class="form-control">
                </select>
            </div>
            <div class="col-sm-3" style="text-align:left">
                <button type="button" id="sReset" class="btn btn-warning" style="margin-left: 0px; margin-right: 0px; height: 34px; margin-top: 0px;"><i class="fa fa-refresh"></i></button>
                <button type="button" id="sSearch" class="btn btn-info" style="margin-top: 0px; height: 34px;"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</div>

<table id="tblData" class="table table-responsive" width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Lokasi</th>
        <th>Nama Barang</th>
        <th>Stock</th>
        <th>Overdue Date</th>
        <!-- <th>Stock</th>
        <th>Satuan Barang</th> -->
    </tr>
    </thead>

    <tbody>
    
    </tbody>
</table>
<!-- </div> -->

<!-- Modalss -->
<div id="modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
<div id="modalDialog" class="modal-dialog modal-lg" style="width: 550px">
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
            <table class="table table-stripped" id="tblModal">
                <tr>
                    <td>ID Barang</td>
                    <td><input type="text" class="form-control" name="data[id_barang]" id="id_barang" style="width: 200px"></td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td><input type="text" class="form-control" name="data[nama]" id="nama" style="width: 200px"></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td style="text-align: left !important ">
                        <select name="data[kategori]" id="kategori" class="form-control" style="width: 200px">
                        
                        </select>
                </td>
                </tr>

                <tr>
                    <td>Satuan Barang</td>
                    <td><input type="text" class="form-control" name="data[satuan]" id="satuan" style="width: 200px"></td>
                </tr>

                <tr>
                    <td>Batas Usia (Tahun)</td>
                    <td><input type="text" class="form-control" name="data[batas]" id="batas" onkeypress="return isNumber(event)" maxlength="2" style="width: 80px"></td>
                </tr>
                <tr>
                    <td>Stock</td>
                    <td><input type="text" class="form-control" name="data[stock]" id="stock" onkeypress="return isNumber(event)" maxlength="5" style="width: 80px"></td>
                </tr>

            </table>
            

            <!-- <div class="form-group">
                <label for="fileFoto" class="control-label col-sm-3">Foto :</label>
                <div class="col-sm-8">
                    <input id="fileFoto" name="fileFoto" type="file" accept="image/*">
                    <input type="hidden" name="tempelFoto" id="tempelFoto">
                    <img id="fotobox" src="" alt="Foto Anda.." align="left" style="display: none" width="100" height="100">
                </div>
            </div> -->

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    <button type="button" class="btn btn-warning form-control" id="reset" tabindex="-2">Reset</button>
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