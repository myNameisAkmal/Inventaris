<html>
<head>
    <title>Transasction Form</title>
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

            $('#product').append($('<option></option>').attr('value', '').attr('selected', true).text('Choose The Product')).attr('disabled', true) ;


            // $('#category').chosen({
            //     width: '100',
            //     no_results_text: "Data Tidak Ada Untuk : "
            // }) ;

            // $('#product').chosen({
            //     width: '100',
            //     no_results_text: "Data Tidak Ada Untuk : "
            // }) ;

            $.getJSON(
                "<?php echo base_url('Latihan/getCategory') ?>",
                function(x) {
                    $('#category').empty() ;
                    $('#category').append($('<option></option>').attr('value', '').attr('selected', true).attr('style', 'display: none').text('Choose The Category')) ;
                    $.each(x, function(row, value) {
                        $('#category').append($('<option></option>').attr('value', x[row].category_id).text(x[row].category_name)) ;
                    }) ;
                }
            ) ;

            $('#category').change(function() {
                var catId = $(this).val() ;
                
                $('#product').attr('disabled', false) ;
                $.getJSON(
                    "<?php echo base_url('Latihan/getProduct/') ?>" + catId,
                    function(x) {
                        $('#product').empty() ;
                        $('#product').append($('<option></option>').attr('value', '').attr('selected', true).attr('style', 'display: none').text('Choose The Product')) ;
                        $.each(x, function(row, value) {
                            $('#product').append($('<option></option>').attr('value', x[row].product_id).text(x[row].product_name)) ;
                        }) ;
                    }
                ) ;
            }) ;




            //JQUERY END
        }) ;
    </script>
</head>
<body>
<div id="alert">
</div>

<div id="form">
    <form name="inputData" id="inputData" method="POST">
        <table>
            <tr>
                <td><label for="transNo">Transaction No.</label></td>
                <td>:</td>
                <td><input type="text" name="transNo" id="transNo"></td>
            </tr>

            <tr>
                <td><label for="custName">Customer Name</label></td>
                <td>:</td>
                <td><input type="text" name="custName" id="custName"></td>
            </tr>

            <tr>
                <td><label for="category">Category</label></td>
                <td>:</td>
                <td>
                    <select name="category" id="category">
                        
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="product">Product</label></td>
                <td>:</td>
                <td>
                    <select name="product" id="product">

                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="price">Price</label></td>
                <td>:</td>
                <td><input type="text" name="price" id="price"></td>
            </tr>

            <tr>
                <td><label for="qty">Qty</label></td>
                <td>:</td>
                <td><input type="text" name="qty" id="qty"></td>
            </tr>

            <tr>
                <td><label for="total">Total</label></td>
                <td>:</td>
                <td><input type="text" name="total" id="total"></td>
            </tr>

            <tr>
                <td colspan="3" align="right"><input type="button" id="klik" name="proses" value="Done"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>