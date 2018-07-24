<!DOCTYPE html>
<html>
<head>
	<title>LATIHAN</title>
	<script src="<?php echo base_url('assets/JQuery.js') ?>"></script>

	<script>
	$(function() {
		// var firstTable = "<tr><th>Provinsi</th><th>Kabupaten</th><th>Kecamatan</th><th>Kelurahan</th></tr>" ;

		function load() {
			$.getJSON("<?php echo base_url('Latihan/getData') ?>",
                function(x) {
                    $.each(x, function(row, val) {
                    	var table = "<tr>" ;
                    	$.each(val, function(key, value) {
                    		table += "<td>" + val[key] + "</td>" ;
                    	}) ;
                    	table += "</tr>" ;
                    	$('#istable tbody').append(table) ;
                    }) ;
                }
         ) ;
		}

		load() ;

		$('#search').keyup(function() {
			$('#istable tbody').remove() ;
			var data = $(this).val() ;

			if (data != "") {
				$.getJSON("<?php echo base_url('Latihan/getDataSearch/') ?>" + data,
	                function(x) {
	                    $.each(x, function(row, val) {
	                    	var table = "<tr>" ;
	                    	$.each(val, function(key, value) {
	                    		table += "<td>" + val[key] + "</td>" ;
	                    	}) ;
	                    	table += "</tr>" ;
	                    	$('#istable').append($('<tbody></tbody>').append(table)) ;
	                    }) ;
	                }
	         	) ;
			}
			else {
				load() ;
			}
		}) ;

	}) ;
	</script>
</head>
<body>
<input type="text" name="search" id="search">

<table border="1" id="istable">
<thead>
	<tr>
		<th>Provinsi</th>
		<th>Kabupaten</th>
		<th>Kecamatan</th>
		<th>Kelurahan</th>
	</tr>
</thead>
<tbody>
</tbody>
	<!-- 
	<?php
		// foreach ($loc as $data) {
		// 	echo "<tr align='center'>";
		// 	echo "<td> $data->Provinsi </td>";
		// 	echo "<td> $data->Kabupaten </td>";
		// 	echo "<td> $data->Kecamatan </td>";
		// 	echo "<td> $data->Kelurahan </td>";
		// 	echo "</tr>" ;
		// }
	
	?>
	-->
</table>
</body>
</html>