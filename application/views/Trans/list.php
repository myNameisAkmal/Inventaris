<script type="text/javascript">
	function isNumber(evt) {
	    evt = (evt) ? evt : window.event;
	    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	        return false;
	    }
	    return true;
	}
</script>
<table id="listTrans" class="table table-responsive" width="100%">
    <thead>
    <tr>
        <th>Transaction No.</th>
        <th>Transaction Date</th>
        <th>Product Category</th>
        <th>Product Name</th>
        <th>Qty x Price</th>
        <th>Total</th>
        <!-- <th>Action</th> -->
    </tr>
    </thead>

    <tbody>
    <?php
    	// foreach ($trans as $data) {
    	// 	echo "<tr>";
    	// 	echo "<td>".$data->noTrans."</td>";
    	// 	echo "<td>".$data->date."</td>";
    	// 	echo "<td>".$cat[$data->product_id]."</td>";
    	// 	echo "<td>".$prod[$data->product_id]."</td>";
    	// 	echo "<td>".$data->qty.' x Rp. '.number_format($price[$data->product_id])."</td>";
    	// 	echo "<td>".'Rp. '.number_format($data->total)."</td>";
    	// 	echo "<td>".$data->noTrans."</td>";
    	// 	echo "</tr>";
    	// }
    ?>
    </tbody>
</table>

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
	        <form name="transaksi" id="transaksi" method="POST" class="form-horizontal" action="<?php echo base_url('Trans/saveTrans')?>">
				<div class="form-group">
			        <label class="control-label col-sm-3" for="transNo">Transaction No. :</label>
			        <div class="col-sm-8">
			            <input type="text" class="form-control" name="data[transNo]" id="transNo" value="" readonly>
			        </div>
			    </div>

				<div class="form-group">
			        <label class="control-label col-sm-3" for="datePick">Tanggal Transaksi :</label>
			        <div class="col-sm-8">
			            <input type="text" class="form-control" name="data[date]" id="datePick" value="<?php echo date('l, d F Y') ;?>" readonly>
			        </div>
			    </div>

			    <div class="form-group">
				    <label class="control-label col-sm-3" for="cat">Category :</label>
				    <div class="col-sm-8">
				        <select name="data[cat]" id="cat" class="form-control">
				        	<option value="x" selected disabled style="display: none">Please Choose Category</option>
				            <?php
				            	foreach ($category as $dataCat) {
				            		echo "<option value='".$dataCat->category_id."'>".$dataCat->category_name."</option>";
				            	}
				            ?>
				        </select>
				    </div>
				</div>

				<div class="form-group">
				    <label class="control-label col-sm-3" for="prod">Product :</label>
				    <div class="col-sm-8">
				        <select name="data[prod]" id="prod" class="form-control">
				            <option value="x" selected disabled style="display: none">Please Choose Product</option>
				            <?php
				            	foreach ($product as $dataProd) {
				            		echo "<option value='".$dataProd->product_id."' value2='".$dataProd->price."' class='".$dataProd->category_id."' style='display:none'>".$dataProd->product_name."</option>";
				            	}
				            ?>
				        </select>
				    </div>
				</div>

				<div class="form-group">
			        <label class="control-label col-sm-3" for="price">Price :</label>
			        <div class="col-sm-8">
			            <input type="text" class="form-control" name="data[price]" id="price" placeholder="Rp. 0" readonly>
			        </div>
			    </div>

			    <div class="form-group">
			        <label class="control-label col-sm-3" for="qty">Qty :</label>
			        <div class="col-sm-8">
			            <input type="text" class="form-control" name="data[qty]" id="qty" onkeypress="return isNumber(event)" maxlength="2" placeholder="Maximum : 99">
			        </div>
			    </div>

			    <div class="form-group">
			        <label class="control-label col-sm-3" for="total">Total :</label>
			        <div class="col-sm-8">
			            <input type="text" class="form-control" name="data[total]" id="total" placeholder="Rp. 0" readonly>
			        </div>
			    </div>

			    <div class="form-group">
			    	<div class="col-sm-8"></div>
			        <div class="col-sm-3">
			        	<input type="hidden" name="data[_doWhat]" id="_doWhat" value="update">
			            <button type="button" class="btn btn-info form-control" id="save" data="">Save</button>
			        </div>
			    </div>
			</form>
        </div>
        <!-- END Modal Body -->
    </div>

</div>
</div>
<script>
	$(document).ready(function() {

		var temp_cat = '';
		var temp_price = '';

		function loadData(id) {
			$.ajax({
	            type : 'POST',
	            url : '<?php echo base_url('Trans/getListWithWhere')?>',
	            data : {id : id},
	            dataType : 'JSON',
	            success : function(x) {
	            	var data = x.trans[0] ;
	                $('#transNo').val(data.noTrans);
	                $('#datePick').val(data.date);
	                $('#price').val('Rp. '+formatNumber(data.price));
	                $('#qty').val(data.qty);
	                $('#total').val('Rp. '+formatNumber(data.total));

	                $('#cat').val(data.category_id);
        			$('#cat').trigger("chosen:updated");
	                $('#prod').val(data.product_id);
	                $('.'+data.category_id).attr('style', 'display:block');
        			$('#prod').trigger("chosen:updated");

        			temp_cat = data.category_id;
        			temp_price = data.price;
	            }
	        }) ;
		}

		function valid() {
            cat = $('#cat').val() ;
            prod = $('#prod').val() ;
            price = $('#price').val() ;
            qty = $('#qty').val() ;
            total = $('#total').val() ;

            if (cat != 'x' && prod != 'x' && price != '' && qty != '' && total != '') {
                return true ;
            }
            else {
                // alert('Data Belum Lengkap !!!') ;
                swal('Oops!!!','Data Belum Lengkap','error') ;
                return false ;
            }
        }

		$('#modal .close').click(function() {
            if (temp_cat != '') {
    			$('.'+temp_cat).attr('style', 'display:none');
    		}
        }) ;

		$('#cat').change(function() {
        	var x = $(this).val();

        	if (x != 'x') {
        		$('#prod').attr('disabled', false);
        		$('.'+x).attr('style', 'display:block');
        		if (temp_cat != '') {
        			$('.'+temp_cat).attr('style', 'display:none');
        		}
        		$('#prod').val('x');
        		$('#prod').trigger("chosen:updated");
        	}
        	$('#price').val('');
        	$('#total').val('');
        	temp_cat = x ;
        });

        $('#prod').change(function() {
        	if ($(this).val() != 'x') {
        		var s = $('select[name="data[prod]"] :selected').attr('value2');
        		$('#price').val('Rp. '+formatNumber(s));
        		temp_price = s;
        	}

        	var x = $('#qty').val();
        	if (x != '') {
        		var total = parseInt(x) * temp_price ;

        		$('#total').val('Rp. '+formatNumber(total));
        	}
        });

        $('#qty').keyup(function() {
        	var x = $(this).val();
        	if (x != '') {
        		var total = parseInt(x) * temp_price ;

        		$('#total').val('Rp. '+formatNumber(total));
        	}
        	else {
        		$('#total').val('');
        	}
        });

		var table ;
        table = $('#listTrans').DataTable({
            dom: "Bfrtip",
            responsive: true,
            select: true,
            filter: true,
            paging: true,
            pageLength: 5,
            serverSide: false,
            processing: false,
            buttons: [
	            {text: " Edit", className: "btn btn-warning fa fa-pencil", enabled: true, action: function() {
	                var row = table.rows('.selected').indexes();
	                if (row.length < 1) {
	                    swal("Information", "You Haven't Choose An Order Yet!", "info") ;
	                    return ;
	                }

	                var data = table.rows(row).data();
                    var id = data[0].noTrans ;

	                loadData(id) ;
	                $('#modalTitle').html('Update Transaction');
	                $('#modal').modal("show");
	            }},
            	{text: " Delete", className: "btn btn-danger fa fa-trash-o", enabled: true, action: function() {
                    var row = table.rows('.selected').indexes();
                    if (row.length < 1) {
                        swal("Information", "You Haven't Choose An Order Yet!", "info") ;
                        return ;
                    }
                    else {
                        var data = table.rows(row).data();
                        var id = data[0].noTrans ;
                        swal({
                            title: 'Warning',
                            text: 'Delete Order '+id+'?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Delete!'
                            }).then(function() {
                                $.ajax({
                                    type : 'POST',
                                    url : "<?php echo base_url('Trans/deleteTrans') ?>",
                                    data : {id:id},
                                    success : function(x) {
                                    	$('#modal').modal("hide");
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
                url: "<?php echo base_url('Trans/getList') ?>",
                dataSrc: "trans"
            },
            columns: [
                {data: "noTrans", name: "noTrans", sortable: true, searchable: true},
                {data: "date", name: "date", sortable: true, searchable: true},
                {data: "category_name", name: "category_name", sortable: false, searchable: false},
                {data: "product_name", name: "product_name", sortable: false, searchable: false},
                {data: "price", name: "price", render: function(data, type, row, meta) {
                    return row.qty+' x Rp. '+formatNumber(data);
                }, sortable: false, searchable: false},
                {data: "total", name: "total", render: function(data, type, row, meta) {
                    return 'Rp. '+formatNumber(data);
                }, sortable: false, searchable: false}
            ],
            language: {
                search: "Search: ",
                searchPlaceholder: " Transaction No."
            }

        });

        $('#save').click(function() {
        	if (valid() == true) {
        		var x = new FormData($('#transaksi')[0]) ;
        		$.ajax({
                    url : "<?php echo base_url('Trans/saveTrans') ?>",
                    type : "POST",
                    data : x,
                    processData : false,
                    contentType : false,
                    cache : false,
                    async : false,
                    dataType : "JSON",
                    success : function(x) {
                        if(x.sts == "v") {
                        	$('#modal').modal("hide");
                            swal("Ok", x.msg, "success", false).then(function() {
                            	table.ajax.reload(null, true);
                            }) ;
                        }
                        else {
                        	$('#modal').modal("hide");
                            swal("Sorry", x.msg, "error", false) ;
                        }
                    }
                }) ;
        	}
        });

	});
</script>

<style>
	.table > tbody > tr > td {
		vertical-align: middle;
	}
	div.dt-buttons {
      position: relative;
      float: left;
    }
</style>