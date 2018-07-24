
<!DOCTYPE HTML>
<html>
<head>
	<title>Admin Page Designed By w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Augment Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- 	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script> -->
	<!-- Bootstrap Core CSS -->
	<!-- <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel='stylesheet' type='text/css' /> -->
	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/css/style_adm.css') ?>" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
	<!-- jQuery -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icon-font.min.css') ?>" type='text/css' />
	<!-- //lined-icons -->
	<script src="<?php echo base_url('assets/jQuery.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/amcharts.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/serial.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/light.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/radar.js') ?>"></script>
	<link href="<?php echo base_url('assets/css/fabochart.css') ?>" rel='stylesheet' type='text/css' />
	<!--clock init-->
	<script src="<?php echo base_url('assets/js/css3clock.js') ?>"></script>
	<!--Easy Pie Chart-->
	<!--skycons-icons-->
	<script src="<?php echo base_url('assets/js/skycons.js') ?>"></script>

	<!--//skycons-icons-->

    <!-- TAMBAHAN PLUGIN -->
    <!-- <script src="<?php echo base_url('assets/UI/jquery-ui.min.js') ?>"></script> -->
    <script src="<?php echo base_url('assets/pickDate/lib/picker.js') ?>"></script>
    <script src="<?php echo base_url('assets/pickDate/lib/picker.date.js') ?>"></script>
    <script src="<?php echo base_url('assets/select/chosen.jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/swal/dist/sweetalert2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/fileStyle2/src/bootstrap-filestyle.min.js')?>"> </script>

    <script src="<?php echo base_url('assets/dataTables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/dataTables/js/dataTables.select.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/dataTables/js/datatables.min.js') ?>"></script>

    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/UI/themes/eggplant/jquery-ui.min.css') ?>"> -->
    
    <link href="<?php echo base_url('assets/dataTables/css/datatables.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dataTables/css/select.dataTables.min.css') ?>" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo base_url('assets/pickDate/lib/themes/classic.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/pickDate/lib/themes/classic.date.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/select/chosen.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/swal/dist/sweetalert2.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/fileStyle/test/css/bootstrap.min.css')?>">
    <!-- Bootstrap CSS OKE nih -->

    <style>
    
    </style>
  <!-- END TAMBAHAN PLUGIN -->

</head>
<body>
<div class="page-container">
	<!--/content-inner-->
	<div class="left-content">
		<div class="inner-content">
			<!-- header-starts -->
			<div class="header-section">
				<!--menu-right-->
				<div class="top_menu">
					
					<!--/profile_details-->
					<div class="profile_details_left">
						<div class="notification-dropdown">
							<header class="logo">
								<span id="logo"> <h1>IK - M - 351</h1> </span>
							</header>
						</div>
					</div>
					<div class="clearfix"></div>
					<!--//profile_details-->
				</div>
				<!--//menu-right-->
				<div class="clearfix"></div>
			</div>
			<!-- //header-ends -->
			<div class="outter-wp">
				<!--custom-widgets-->
				<div class="custom-widgets">
					<div class="row-one">
						<?php echo @$header ?>
					</div>
				</div>
				<!--//custom-widgets-->
						<div class="area-charts" align="center">
                            <!--CONTENT-->
                            	<?php echo @$content ?>
                            <!-- END CONTENT -->
							<div class="clearfix"> </div>
						</div>
						<!--/bottom-grids-->
						<div class="bottom-grids">
							<?php echo @$footer ?>
						</div>
						<!--//bottom-grids-->

					</div>
					<!--/charts-inner-->
				</div>
				<!--//outer-wp-->
			</div>
			<!--footer section start-->
			<!-- <footer>
				<p>&copy 2016 Augment . All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">W3layouts.</a></p>
			</footer> -->
			<!--footer section end-->
		</div>
	</div>
	<!--//content-inner-->
	<!--/sidebar-menu-->
	<div class="sidebar-menu">
		<header class="logo">
			<a href=""> <span id="logo"> <h1>CI - XML</h1></span>
				<!--<img id="logo" src="" alt="Logo"/>-->
			</a>
		</header>
		<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
		<!--/down-->
		<div class="down">
			<a href=""><img src="<?php echo base_url('assets/images/1440904225301.jpg') ?>"></a>
			<a href=""><span class=" name-caret">Naufal Akmal Fauzi</span></a>
			<p>System Administrator in Company</p>
			<ul>
				<li><a class="tooltips" href=""><span>Profile</span><i class="lnr lnr-user"></i></a></li>
				<li><a class="tooltips" href=""><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
				<li><a class="tooltips" href=""><span>Log out</span><i class="lnr lnr-power-switch"></i></a>
				</li>
			</ul>
		</div>
		<!--//down-->
		<div class="menu">
			<ul id="menu" >
				<li><a href="<?php echo base_url() ?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

				<!-- <li><a href="/admin/data"><i class="fa fa-file-text-o"></i> <span>Data</span></a></li>
				<li><a href="/user/data"><i class="fa fa-file-text-o"></i> <span>Data User</span></a></li>
				<li><a href="/user/order"><i class="fa fa-file-text-o"></i> <span>User Order</span></a></li> -->

                <li><a href="<?php echo base_url('invent') ?>"><i class="fa fa-file-text-o"></i> <span>Data Barang </span></a></li>

                <li><a href="#"><i class="fa fa-list"></i> <span>Data Kategori </span></a></li>

                <li><a href="#"><i class="fa fa-pencil-square-o"></i> <span>Data Lokasi </span></a></li>

				<li><a href="#"><i class="fa fa-pencil-square-o"></i> <span>Transaksi Penempatan </span></a></li>

<!--         <li><a href="" class="klikTable"><i class="fa fa-file-text-o"></i> <span>Data</span></a></li> -->
					
			</ul>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<script>
    var toggle = true;

    $(".sidebar-icon").click(function() {
        if (toggle)
        {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position":"absolute"});
        }
        else
        {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function() {
                $("#menu span").css({"position":"relative"});
            }, 400);
        }

        toggle = !toggle;
    });

    //START
    function formatNumber(data) {
      if(data==null){
        data =0;
      }
      // alert(data);
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

    }

    // JQUERY

</script>
<!--js -->
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/vroom.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/vroom.js') ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/js/TweenLite.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/CSSPlugin.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.nicescroll.js') ?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>
