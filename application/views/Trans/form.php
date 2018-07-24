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
<?php
// var_dump($product);
$no = $transNo[0]->transNo;
if (is_null($no)) {
	$no = "TR001";
}
else {
	$x = (int)substr($no, 2);
	$x = $x + 1;
	if ($x < 10) {
		$no = "TR00".$x;
	}
	else if ($x < 100) {
		$no = "TR0".$x;
	}
	else {
		$no = "TR".$x;
	}
}
?>
<form name="transaksi" id="transaksi" method="POST" class="form-horizontal" action="<?php echo base_url('Trans/saveTrans')?>">
	<div class="form-group">
        <label class="control-label col-sm-3" for="transNo">Transaction No. :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="data[transNo]" id="transNo" value="<?php echo $no ?>" readonly>
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
	        <select name="data[prod]" id="prod" class="form-control" disabled>
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
        	<input type="hidden" name="data[_doWhat]" id="_doWhat" value="insert">
            <button type="button" class="btn btn-info form-control" id="save" data="">Save</button>
        </div>
    </div>
</form>

<script>
	$(document).ready(function() {
		var temp_cat = '';
		var temp_price = '';

		$('#cat').chosen({
            width: '100%',
            no_results_text: "No Result For : "
        }) ;

        $('#prod').chosen({
            width: '100%',
            no_results_text: "No Result For : "
        }) ;

        $('#cat').change(function() {
        	// var x = $('select[name="data[cat]"] :selected').attr('class');
        	// alert(x);
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
                            	location.reload();
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
	}) ;
</script>