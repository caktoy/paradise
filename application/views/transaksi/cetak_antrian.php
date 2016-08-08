<!DOCTYPE html>
<html>
<head>
	<title>Cetak Antrian</title>
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

	#nomer-antri {
		display: block;
		font-weight: bold;
		font-size: 24pt;
		text-align: center;
		margin: 5px;
	}

	#poli {
		display: block;
		font-weight: bold;
		font-size: 14pt;
		text-align: center;
	}
	</style>
</head>
<body onload="window.print();">
	<div id="frame">
		<div id="header">
			<img src="<?php echo base_url().'assets/images/logo-parisudha.png' ?>">
			<span id="title">
				Kartu Antrian<br>
				<span id="subtitle">Jl. Rungkut Menanggal Harapan J/9<br>telp. 085649806178 pin: 24CCCEFA</span>
			</span>
		</div>
		<div style="display: block;text-align: center;margin-top: 5px;">Nomer Antrian</div>
		<div id="nomer-antri"><?php echo $no_antri; ?></div>
		<div id="poli"><?php echo $poli[0]->NM_POLI; ?></div>
		<div id="content">
			<table style="width: 100%;">
				<tr>
					<td style="width: 25%;">Pasien</td>
					<td>:</td>
					<td><?php echo "#".$pasien[0]->ID_PASIEN." - ".$pasien[0]->NM_PASIEN ?></td>
				</tr>
				<tr>
					<td>No. Telp</td>
					<td>:</td>
					<td><?php echo $pasien[0]->TELP_PASIEN ?></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>