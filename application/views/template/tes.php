    <script src="<?php echo base_url('assets/jQuery.js') ?>"></script>
    <script src="<?php echo base_url('assets/dataTables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/dataTables/js/dataTables.select.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/dataTables/js/datatables.min.js') ?>"></script>

    <link href="<?php echo base_url('assets/dataTables/css/datatables.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dataTables/css/select.dataTables.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('assets/fileStyle/test/css/bootstrap.min.css')?>">

    <script>
        $(function() {
            var table ;
            table = $('#thisTbl').DataTable({
                dom: "Bfrtip",
                responsive: true,
                select: true,
                filter: false,
                paging: false,
                serverSide: false,
                processing: false,
                buttons: [
                    {text: "Add", className: "btn btn-primary fa fa-plus", enabled: true,
                    action: function() {
                        $('#modalTitle').html('Tambah Data');
                        $('#modal').modal("show");
                    }},
                ],
                ajax: {
                    url: "<?php echo base_url('CTemplate/getData') ?>",
                    dataSrc: "mhs"
                },
                columns: [
                    {data: "nim", name: "nim"},
                    {data: "nama", name: "nama"},
                    {data: "tgl_lahir", name: "tgl_lahir", render: function(data, type, row){
                        var date = new Date(data) ;
                        return date.toLocaleString("id-id", {day: "numeric", month: "long", year: "numeric"})
                    }},
                    {data: "agama", name: "agama"},
                    {data: "foto", name: "foto", render: function(data, type, row){
                        var foto = "<?php echo base_url('assets/images/') ?>"+data ;

                        return "<img src='"+foto+"' height='80px' width='80px' />" ;
                    }, sortable: false}
                ]

            });
        }) ;
    </script>


    <table id="thisTbl" width="100%" class="table">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

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
                                                    <input type="text" class="form-control" name="nim" id="nim">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="nama">Nama Mahasiswa :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="nama" id="nama">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="datePick">Tanggal Lahir :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="datePick" id="datePick" data-value="<?php echo date('y/m/d') ;?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="agama">Agama :</label>
                                                <div class="col-sm-8">
                                                    <select name="agama" id="agama" class="form-control">
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