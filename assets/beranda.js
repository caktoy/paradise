$(function() {
	grafikKunjungan();
	grafikRegistrasi();
	grafikPenyakit();
	grafikPemeriksaan();
	grafikLab();
	grafikObat();
	grafikPendapatan();
});

function grafikKunjungan() {
	var options = {
        chart: {
            renderTo: 'grafikKunjungan',
            type: 'column'
        },
        credits: false,
        title: {
            text: 'Kunjungan Pasien per Bulan'
        },
        subtitle: {
            text: 'Tahun ' + (new Date().getFullYear())
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Kunjungan'
            }
        },
        series: null
    };

    $.getJSON('kunjungan', function(data) {
        options.series = data;
        var chart = new Highcharts.Chart(options);
    });
}

function grafikRegistrasi() {
	var options = {
        chart: {
            renderTo: 'grafikRegistrasi',
            type: 'column'
        },
        credits: false,
        title: {
            text: 'Registrasi Pasien per Bulan'
        },
        subtitle: {
            text: 'Tahun ' + (new Date().getFullYear())
        },
        legend: {
        	enabled: false
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Registrasi'
            }
        },
        series: [{}]
    };

    $.getJSON('registrasi', function(data) {
        options.series[0].name = "Pasien";
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
    });
}

function grafikPenyakit() {
	var options = {
        chart: {
            renderTo: 'grafikPenyakit',
            type: 'column'
        },
        credits: false,
        title: {
            text: 'Diagnosa Penyakit Terbanyak per Bulan'
        },
        subtitle: {
            text: 'Tahun ' + (new Date().getFullYear())
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Diagnosa'
            }
        },
        series: null
    };

    $.getJSON('penyakit', function(data) {
        options.series = data;
        var chart = new Highcharts.Chart(options);
    });
}

function grafikPemeriksaan() {
	var options = {
        chart: {
            renderTo: 'grafikPemeriksaan',
            type: 'column'
        },
        credits: false,
        title: {
            text: 'Kunjungan Pasien Dokter per Bulan'
        },
        subtitle: {
            text: 'Tahun ' + (new Date().getFullYear())
        },
        legend: {
        	enabled: false
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Kunjungan'
            }
        },
        series: [{}]
    };

    $.getJSON('kunjungan_dokter', function(data) {
        options.series[0].name = "Kunjungan";
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
    });
}

function grafikLab() {
	var options = {
        chart: {
            renderTo: 'grafikLab',
            type: 'column'
        },
        credits: false,
        title: {
            text: 'Pemeriksaan Lab per Bulan'
        },
        subtitle: {
            text: 'Tahun ' + (new Date().getFullYear())
        },
        legend: {
        	enabled: false
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Pemeriksaan'
            }
        },
        series: [{}]
    };

    $.getJSON('pemeriksaan_lab', function(data) {
        options.series[0].name = "Pemeriksaan";
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
    });
}

function grafikObat() {
	var options = {
        chart: {
            renderTo: 'grafikObat',
            type: 'column'
        },
        credits: false,
        title: {
            text: 'Jumlah Obat Keluar per Bulan'
        },
        subtitle: {
            text: 'Tahun ' + (new Date().getFullYear())
        },
        legend: {
        	enabled: false
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Obat (Satuan)'
            }
        },
        series: [{}]
    };

    $.getJSON('obat_keluar', function(data) {
        options.series[0].name = "Jumlah Obat";
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
    });
}

function grafikPendapatan() {
	var options = {
        chart: {
            renderTo: 'grafikPendapatan',
            type: 'line'
        },
        credits: false,
        title: {
            text: 'Pendapatan per Bulan'
        },
        subtitle: {
            text: 'Tahun ' + (new Date().getFullYear())
        },
        legend: {
        	enabled: false
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Pendapatan (Rp)'
            }
        },
        series: [{}]
    };

    $.getJSON('pendapatan', function(data) {
        options.series[0].name = "Pendapatan";
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
    });
}