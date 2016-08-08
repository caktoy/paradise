<!DOCTYPE html>
<html>
<head>
	<title>Kartu Pasien</title>
	<style type="text/css">
	#frame {
		/*background: url('<?php echo base_url(); ?>assets/images/bg-kartu.png') no-repeat scroll;
		background-size: 100% 100%;
		background-position: fixed;*/
		border: #00a65a solid 2px;
		width: 10cm;
		/*height: 5.5cm;*/
		min-height: 5.5cm;
		padding: 10px;
		font-family: arial;
		font-size: 10pt;
	}

	#header {
		border-bottom: #00a65a solid 2px;
	}

	#header > img {
		width: 3cm;
		padding: 10px;
	}

	#header > #title {
		float: right;
		font-size: 14pt;
		font-weight: bold;
		text-align: right;
	}

	#subtitle {
		float: right;
		font-size: 8pt;
		font-style: italic;
		font-weight: normal;
	}

	#content {
		margin: 5px;
	}

	#content table tr {
		vertical-align: top;
	}

	#footer {
		display: block;
		font-style: italic;
		font-size: 8pt;
	}
	</style>
</head>
<body onload="window.print();">
	<div id="frame">
		<div id="header">
			<img src="<?php echo base_url().'assets/images/logo-parisudha.png' ?>">
			<span id="title">
				Kartu Pasien<br>
				<span id="subtitle">Jl. Rungkut Menanggal Harapan J/9<br>telp. 085649806178 pin: 24CCCEFA</span>
			</span>
		</div>
		<div id="content">
			<table style="width: 100%;">
				<tr>
					<td style="width: 25%;">No. Pasien</td>
					<td>:</td>
					<td><?php echo $pasien->ID_PASIEN ?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><?php echo $pasien->NM_PASIEN ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td><?php echo $pasien->ALMT_PASIEN ?></td>
				</tr>
				<tr>
					<td>TTL</td>
					<td>:</td>
					<td><?php echo $pasien->NM_KOTA.', '.date('d M Y', strtotime($pasien->TGL_LHR_PASIEN)) ?></td>
				</tr>
				<tr>
					<td>No. Telp</td>
					<td>:</td>
					<td><?php echo $pasien->TELP_PASIEN ?></td>
				</tr>
			</table>
		</div>
		<div id="footer">
			*) Harap dibawa saat melakukan pemeriksaan.
		</div>
	</div>
</body>
</html>