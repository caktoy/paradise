<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Parisudha</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <style type="text/css">
    #frame {
		border: black solid 2px;
		width: 15cm;
		min-height: 5.5cm;
		padding: 10px;
		font-family: monospace;
		font-size: 10pt;
		text-transform: uppercase;
	}

	#header {
		border-bottom: black solid 2px;
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
    </style>
</head>
<body onload="window.print();">
	<div id="frame">
		<div id="header">
			<img src="<?php echo base_url().'assets/images/logo-parisudha-bw.png' ?>">
			<span id="title">
				KLINIK PARADISE<br>
				<span id="subtitle">Jl. Rungkut Menanggal Harapan J/9<br>telp. 085649806178 pin: 24CCCEFA</span>
			</span>
		</div>
		<div class="content">
			<div style="widht: 100%;font-weight: bold;font-size: 14pt;font-weight: bold;text-align: center;"><?php echo $judul ?></div>
			<?php  
			$sub_total_tindakan = 0;
			$sub_total_terapi = 0;
			$sub_total_resep = 0;
			$sub_total_lab = 0;
			?>
			<table>
				<tr>
					<td>No. Transaksi</td>
					<td>:</td>
					<td><?php echo $penjualan[0]->ID_JUAL; ?></td>
				</tr>
				<tr>
					<td>Pasien</td>
					<td>:</td>
					<td><?php echo $rekam_medis[0]->NM_PASIEN; ?></td>
				</tr>
				<tr>
					<td>Dokter</td>
					<td>:</td>
					<td><?php echo $rekam_medis[0]->NM_DOKTER; ?></td>
				</tr>
			</table>
			<table width="100%" border="1" cellspacing="0">
				<thead>
					<tr>
						<th>Item</th>
						<th>Tarif</th>
						<th>Qty</th>
						<th>Sub</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($detil_tindakan) > 0): ?>
	        		<?php foreach ($detil_tindakan as $det_td): ?>
	        		<tr>
	        			<td><?php echo $det_td->NM_ICD_9 ?></td>
	        			<td style="text-align: right;">Rp<?php echo number_format($det_td->HARGA_TINDAKAN, 2, ",", ".") ?></td>
	        			<td style="text-align: right;">1</td>
	        			<td style="text-align: right;">Rp<?php echo number_format($det_td->HARGA_TINDAKAN, 2, ",", ".") ?></td>
	        		</tr>
	        		<?php $sub_total_tindakan += $det_td->HARGA_TINDAKAN; ?>
	        		<?php endforeach ?>
	        		<?php endif ?>

	        		<?php if (count($detil_terapi) > 0): ?>
	        		<?php foreach ($detil_terapi as $det_tp): ?>
	        		<tr>
	        			<td><?php echo $det_tp->NM_TERAPI ?></td>
	        			<td style="text-align: right;">Rp<?php echo number_format($det_tp->BAYAR_TERAPI, 2, ",", ".") ?></td>
	        			<td style="text-align: right;">1</td>
	        			<td style="text-align: right;">Rp<?php echo number_format($det_tp->BAYAR_TERAPI, 2, ",", ".") ?></td>
	        		</tr>
	        		<?php $sub_total_terapi += $det_tp->BAYAR_TERAPI; ?>
	        		<?php endforeach ?>
	        		<?php endif ?>

	        		<?php if (count($hasil_lab) > 0): ?>
	        		<?php foreach ($hasil_lab as $hl): ?>
	        		<tr>
	        			<td><?php echo $hl->LAB ?></td>
	        			<td style="text-align: right;"><?php echo 'Rp'.number_format($hl->HARGA, 2, ",", ".") ?></td>
	        			<td style="text-align: right;">1</td>
	        			<td style="text-align: right;">Rp<?php echo number_format($hl->HARGA, 2, ",", ".") ?></td>
	        		</tr>
	        		<?php $sub_total_lab += $hl->HARGA; ?>
	        		<?php endforeach ?>
	        		<?php endif ?>

	        		<?php if (count($resep_obat) > 0): ?>
	        		<?php foreach ($resep_obat as $ro): ?>
	        		<tr>
	        			<td><?php echo $ro->NM_OBAT ?></td>
	        			<td style="text-align: right;"><?php echo 'Rp'.number_format($ro->HRG_OBAT, 2, ",", ".") ?></td>
	        			<td style="text-align: right;"><?php echo $ro->QTY_JUAL ?></td>
	        			<td style="text-align: right;">Rp<?php echo number_format($ro->SUB_TOTAL, 2, ",", ".") ?></td>
	        		</tr>
	        		<?php $sub_total_resep += $ro->SUB_TOTAL; ?>
	        		<?php endforeach ?>
	        		<?php endif ?>

	        		<tr>
	        			<td colspan="3" align="right">SUB TOTAL</td>
	        			<td align="right"><?php echo 'Rp'.number_format(($sub_total_tindakan + $sub_total_terapi + $sub_total_resep + $sub_total_lab), 2, ",", "."); ?></td>
	        		</tr>
	        		<tr>
	        			<td colspan="3" align="right">BAYAR</td>
	        			<td align="right"><?php echo 'Rp'.number_format($pembayaran[0]->UANG_BAYAR, 2, ",", ".") ?></td>
	        		</tr>
	        		<tr>
	        			<td colspan="3" align="right">KEMBALI</td>
	        			<td align="right"><?php echo 'Rp'.number_format(($pembayaran[0]->UANG_BAYAR - $pembayaran[0]->TOTAL_BAYAR), 2, ",", ".") ?></td>
	        		</tr>
				</tbody>
			</table>
			<br>Petugas: <?php echo $_SESSION['username'] ?>
			<br>Tanggal Cetak: <?php echo date('d-m-Y'); ?>
		</div>
	</div>
</body>

<script type="text/javascript">
	$(function() {
		var diskon = $('#txt_diskon').val();
		var total = $('#txt_total').val();
		var total_bayar = total - (total * (diskon / 100));
		$('#lbl_total_bayar').html('Rp' + total_bayar);
		$('#txt_total_bayar').val(total_bayar);
		$('#txt_diskon').change(function() {
			var diskon = $(this).val();
			var total = $('#txt_total').val();
			var total_bayar = total - (total * (diskon / 100));
			$('#lbl_total_bayar').html('Rp' + total_bayar);
			$('#txt_total_bayar').val(total_bayar);
		});
	});
</script>
</html>