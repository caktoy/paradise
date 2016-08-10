<div class="row">
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikKunjungan"></div>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box box-success">
			<!--Body Content-->
			<div class="box-body">
				<div style="width: 100%;height: 400px;margin: 0 auto;" id="grafikPenyakit"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
	    $('#grafikKunjungan').highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: 'Kunjungan Pasien'
	        },
	        subtitle: {
	            text: 'per Bulan'
	        },
	        credits: false,
	        xAxis: {
	            categories: [
	                'Jan',
	                'Feb',
	                'Mar',
	                'Apr',
	                'Mei',
	                'Jun',
	                'Jul',
	                'Agu',
	                'Sep',
	                'Okt',
	                'Nov',
	                'Des'
	            ],
	            crosshair: true
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Jumlah Kunjungan (Pemeriksaan)'
	            }
	        },
	        tooltip: {
	            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	                '<td style="padding:0"><b>{point.y} Kunjungan</b></td></tr>',
	            footerFormat: '</table>',
	            shared: true,
	            useHTML: true
	        },
	        plotOptions: {
	            column: {
	                pointPadding: 0.2,
	                borderWidth: 0
	            }
	        },
	        series: [
	        <?php foreach ($kunjungan_pasien_bulan as $kunjungan): ?>
	        {
	        	name: <?php echo "'".$kunjungan['name']."'" ?>,
	        	data: [<?php foreach($kunjungan['data'] as $data) { echo $data.','; } ?>]
	        },
	        <?php endforeach ?>
	        ]
	    });

		$('#grafikPenyakit').highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: 'Diagnosa Penyakit Terbanyak'
	        },
	        subtitle: {
	            text: 'per Bulan'
	        },
	        credits: false,
	        xAxis: {
	            categories: [
	                'Jan',
	                'Feb',
	                'Mar',
	                'Apr',
	                'Mei',
	                'Jun',
	                'Jul',
	                'Agu',
	                'Sep',
	                'Okt',
	                'Nov',
	                'Des'
	            ],
	            crosshair: true
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Jumlah Diagnosa'
	            }
	        },
	        tooltip: {
	            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	                '<td style="padding:0"><b>{point.y} Diagnosa</b></td></tr>',
	            footerFormat: '</table>',
	            shared: true,
	            useHTML: true
	        },
	        plotOptions: {
	            column: {
	                pointPadding: 0.2,
	                borderWidth: 0
	            }
	        },
	        series: [
	        <?php foreach ($penyakit_terbanyak_bulan as $diagnosa): ?>
	        {
	        	name: <?php echo "'".$diagnosa['name']."'" ?>,
	        	data: [<?php foreach($diagnosa['data'] as $data) { echo $data.','; } ?>]
	        },
	        <?php endforeach ?>
	        ]
	    });
	});
</script>