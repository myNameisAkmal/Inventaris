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
            var temp_id ;

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
                        // reset(1);
                        getKat();
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
                        var idB = data[0].id_barang ;
                        // console.log(nim); return false;
                        temp_id = idB ;
                        loadData(idB) ;
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
                            var idB = data[0].id_barang ;
                            var nama = data[0].nama_barang ;
                            swal({
                                title: 'Warning',
                                text: 'Data '+nama+' ('+idB+') Akan Dihapus?',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Hapus!'
                                }).then(function() {
                                    $.ajax({
                                        type : 'POST',
                                        url : "<?php echo base_url('Invent/delete/') ?>",
                                        dataType : 'JSON',
                                        data : {id : idB},
                                        success : function(x) {
                                            if(!x.err){
                                                swal("Ok", x.msg, "success", false).then(function() {
                                                    // window.location.reload();
                                                    table.ajax.reload(null, true);
                                                }) ;
                                            }
                                            else {
                                                swal("Sorry", x.msg, "error", false) ;
                                            }
                                        }
                                    }) ;
                                }) ;
                        }
                    }}
                ],
                ajax: {
                    url: "<?php echo base_url('Invent/getData') ?>",
                    dataSrc: "inv"
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
                    {data: "id_barang", name: "id_barang", sortable : false},
                    {data: "nama_barang", name: "nama_barang"},
                    {data: "nama_kategori", name: "nama_kategori"},
                    {data: "batas_usia", name: "batas_usia", sortable : false},
                    {data: "stock", name: "stock", sortable : false},
                    {data: "satuan_barang", name: "satuan_barang", sortable : false},
                ],
                language: {
                    search: "Cari: ",
                    searchPlaceholder: " Nama atau Kategori"
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

            $('#kategori').chosen({
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

            function getKat(par = "") {
                var ex = '' ;
                $.getJSON("<?php echo base_url('Invent/getKategori') ?>", function(data) {
                    $('#kategori').empty() ;
                    $("#kategori").append("<option value='x' selected disabled style='display: none'>Silahkan Pilih Kategori</option>") ;
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
                        $("#kategori").append("<option value='"+val.id_kategori+"' "+ex+">"+val.nama_kategori+"</option>") ;
                    }) ;
                    $('#kategori').trigger("chosen:updated");
                }) ;
            }      

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

<table id="tblData" class="table table-responsive" width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Batas Usia (Tahun)</th>
        <th>Stock</th>
        <th>Satuan Barang</th>
    </tr>
    </thead>

    <tbody>
    
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
                <label class="control-label col-sm-3" for="id_barang">ID Barang :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[id_barang]" id="id_barang">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="nama">Nama Barang :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[nama]" id="nama">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="kategori">Kategori :</label>
                <div class="col-sm-8">
                    <select name="data[kategori]" id="kategori" class="form-control">
                        
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="satuan">Satuan Barang :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[satuan]" id="satuan">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="batas">Batas Usia (Tahun) :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[batas]" id="batas" onkeypress="return isNumber(event)" maxlength="2">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="stock">Stock :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="data[stock]" id="stock" onkeypress="return isNumber(event)" maxlength="4">
                </div>
            </div>

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