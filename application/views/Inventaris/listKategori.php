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
                        var idB = data[0].id_kategori ;
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
                            var idB = data[0].id_kategori ;
                            var nama = data[0].nama_kategori ;
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
                                        url : "<?php echo base_url('Kategori/delete') ?>",
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
                    url: "<?php echo base_url('Kategori/getData') ?>",
                    dataSrc: "kat"
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
                    {data: "id_kategori", name: "id_kategori",},
                    {data: "nama_kategori", name: "nama_kategori"},
                    
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search Here"
                }

            });

            function reset(x) {
                if(x == 1) {
                    $('#save').html('Save') ;
                    $('#id_kategori').prop('readonly', false) ;
                    $('#id_kategori').val('') ;
                    $('#nama_kategori').val('') ;
                }
                else {
                    loadData(temp_id) ;
                }
            }

            function valid() {
                var id = $('#id_kategori').val() ;
                var nama = $('#nama_kategori').val() ;
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
                        console.log(x);
                        $.ajax({
                            url : "<?php echo base_url('Kategori/save') ?>",
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
                        //UPDATE ACT------------------------------------------------------------------

                        var x = new FormData($('#inputData')[0]) ;
                        // console.log(x) ;
                        $.ajax({
                            url : "<?php echo base_url('Kategori/update') ?>",
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
                    url : '<?php echo base_url('Kategori/getData')?>',
                    data : {id : id},
                    dataType : 'json',
                    success : function(x) {
                        // console.log(x);
                        x = x.kat[0];
                        $('#id_kategori').prop('readonly', true) ;
                        $('#id_kategori').val(x.id_kategori) ;
                        $('#nama_kategori').val(x.nama_kategori) ;
                    }
                }) ;
            }

            //JQUERY END
    }) ;
    //END

    // JQUERY

</script>


<table id="tblData" class="table table-responsive" width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>ID Kategori</th>
        <th>Nama Kategori</th>
        
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
                    <td>ID Kategori</td>
                    <td><input type="text" class="form-control" name="data[id_kategori]" id="id_kategori" style="width: 200px" maxlength="6"></td>
                </tr>
                <tr>
                    <td>Nama Kategori</td>
                    <td><input type="text" class="form-control" name="data[nama_kategori]" id="nama_kategori" style="width: 200px"></td>
                </tr>
                
            </table>

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