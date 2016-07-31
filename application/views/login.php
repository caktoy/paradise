<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Paradise Parisudha</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome-4.1.0/css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">	
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">	
		<style type="text/css">
			body{
				background: url('<?php echo base_url(); ?>assets/images/Background_1.jpg') no-repeat scroll;
				background-size: 100% 100%;
				min-height: 500px;
				background-position: fixed;

			}
		</style>
	</head>

	<body class="bg layout-top-nav">
		<div align="center" style="margin-top:50px">
			<br><br>
			<h1><label class="label label-primary" style="border-radius:0">Administrasi Layanan Pasien</label></h1>
			<div class="login-box" style="margin-top:50px">	
				<div class="login-box-body">
					<form action="<?php echo base_url().'auth/login'; ?>" method="post">
						<i><img src="<?php echo base_url(); ?>assets/images/logo-parisudha.png" style="align:center"></i>
						<div class="form-group has-feedback" style="margin-top:30px">
							<input type="username" class="form-control" placeholder="User ID" name="userid" autofocus>
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<input type="password" class="form-control" placeholder="Password" name="password">
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>			
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	
	<!-- jQuery 2.2.0 -->
	<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
</html>
