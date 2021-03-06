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
                    {className: "btn btn-primary fa fa-plus", enabled: true,
                    action: function() {
                        $('#modalTitle').html('Tambah Data');
                        $('#modal').modal("show");
                        $('#save').attr('data', 1);
                    }},
                    {className: "btn btn-warning fa fa-pencil", enabled: true,
                    action: function() {
                        var row = table.rows('.selected').indexes();
                        if (row.length < 1) {
                            swal("Information", "Silahkan Pilih Data Yang Ingin Di Edit", "info") ;
                            return ;
                        }

                        var data = table.rows(row).data();
                        var idB = data[0].id_lokasi ;
                        // console.log(nim); return false;
                        temp_id = idB ;
                        loadData(idB) ;
                        $('#modalTitle').html('Update Data');
                        $('#modal').modal("show");
                        $('#save').html("Update");
                        $('#save').attr('data', 2);
                        // console.log($('#inputData')[0]);
                    }},
                    {className: "btn btn-danger fa fa-trash-o", enabled: true,
                    action: function() {
                        var row = table.rows('.selected').indexes();
                        if (row.length < 1) {
                            swal("Information", "Silahkan Pilih Data Yang Ingin Di Hapus", "info") ;
                            return ;
                        }
                        else {
                            var data = table.rows(row).data();
                            var idB = data[0].id_lokasi ;
                            var nama = data[0].nama_lokasi ;
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
                                        url : "<?php echo base_url('Lokasi/delete/') ?>",
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
                    url: "<?php echo base_url('Lokasi/getData') ?>",
                    dataSrc: "lok"
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
                    {data: "id_lokasi", name: "id_lokasi",},
                    {data: "nama_lokasi", name: "nama_lokasi"},
                    
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search Here"
                }

            });

            function reset(x) {
                if(x == 1) {
                    var n = new Date() ;
                    //var pick = $('#datePick').pickadate(), pDate = pick.pickadate('picker') ;
                    $('#save').html('Save') ;
                    $('#id_lokasi').prop('readonly', false) ;
                    $('#id_lokasi').val('') ;
                    $('#nama_lokasi').val('') ;
                }
                else {
                    loadData(temp_id) ;
                }
            }

            function valid() {
                var id = $('#id_lokasi').val() ;
                var nama = $('#nama_lokasi').val() ;
                if (id != '' && nama != '') {
                    return true ;
                }
                else {
                    // alert('Data Belum Lengkap !!!') ;
                    swal('Oops!!!','Data Belum Lengkap','error') ;
                    return false ;
                }
            }

            $('#save').click(function() {
                // alert('wew');
                var val = $(this).attr('data');
                // console.log(val);
                if (valid() == true) {
                    if  (val == 1) {
                        //INSERT ACT------------------------------------------------------------------
                        var x = new FormData($('#inputData')[0]) ;
                        // console.log(x);
                        $.ajax({
                            url : "<?php echo base_url('Lokasi/save') ?>",
                            type : "POST",
                            data : x,
                            processData : false,
                            contentType : false,
                            cache : false,
                            async : false,
                            dataType : "JSON",
                            success : function(x) {
                                // console.log(data);
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
                            url : "<?php echo base_url('Lokasi/update') ?>",
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
                // alert();
                $.ajax({
                    type : 'POST',
                    url : '<?php echo base_url('Lokasi/getData')?>',
                    data : {id : id},
                    dataType : 'json',
                    success : function(x) {
                        // console.log(x);
                        x = x.lok[0];
                        $('#id_lokasi').prop('readonly', true) ;
                        $('#id_lokasi').val(x.id_lokasi) ;
                        $('#nama_lokasi').val(x.nama_lokasi) ;
                    }
                }) ;
            }

            //JQUERY END
    }) ;

    // JQUERY

</script>


<table id="tblData" class="table table-responsive" width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>ID Lokasi</th>
        <th>Nama Lokasi</th>
        
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
                    <td>ID Lokasi</td>
                    <td><input type="text" class="form-control" name="data[id_lokasi]" id="id_lokasi" style="width: 200px" maxlength="6"></td>
                </tr>
                <tr>
                    <td>Nama Lokasi</td>
                    <td><input type="text" class="form-control" name="data[nama_lokasi]" id="nama_lokasi" style="width: 200px"></td>
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