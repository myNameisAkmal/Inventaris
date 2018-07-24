<html>
<head>
	<title>WELCOME PAGE</title>
    <script src="<?php echo base_url('assets/JQuery.js') ?>"></script>
    <script src="<?php echo base_url('assets/UI/jquery-ui.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/UI/themes/dark-hive/jquery-ui.min.css') ?>">

    <script>
        $(document).ready(function() {
//            alert('SELAMAT DATANG :D') ;
            $("#alert").dialog({
                title : "WELCOME",
                modal : true,
                autoOpen : false,
                dragable : false,
                resizable : false,
//                width : 100,
//                height : 100,
                buttons : {
                    "Ok" : function() {
                        $(this).dialog("close");
                    }
                }
            }) ;

            $('#klik').click(function() {
                var x = "<?php echo base_url() ?>" ;
                var namax = $('#nama').val() ;
                var kotax = $('#kota').val() ;

                $.post(x + '/Data/processData' ,
                    {
                        nama : namax,
                        kota : kotax
                    } ,
                    function(data) {
                        $('#alert').html('<p align=center>'+data+'</p>') ;
                        $('#alert').dialog('open') ;
                    }
                ) ;
            }) ;
        }) ;
    </script>
</head>
<body>
<div id="alert">
</div>
<pre>
<input type="text" id="nama" placeholder="Nama Kamu">   <input type="text" id="kota" placeholder="Asal Kota Kamu">
</pre>
<input type="button" id="klik" value="Show">

<h1><a href="<?php echo base_url().'Data/getData'?>">LANGSUNG SAJA..</a></h1>
</body>
</html>