<!DOCTYPE html>
<html>
<head>
    <title><?php echo $judul ?></title>
</head>
<body <?php if(!isset($cetak)) { echo "onload='javascript:window.print();'"; } ?>>
    <div style="display: block;width: 100%;text-align: center;font-weigth: bold;font-size: 14pt;padding-bottom: 40px;">
        <?php echo $judul; ?><br>
        <?php echo $subjudul; ?><br>
    </div>
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table cellpadding="2" cellspacing="0" border="1" width="100%" 
                                id="<?php echo count($data)>0?"example1":""; ?>" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <th style="text-align: center;width: 15px;">
                                            NO
                                        </th>
                                        <th style="text-align: center;">
                                            ID PASIEN
                                        </th>
                                        <th style="text-align: center;">
                                            NAMA
                                        </th>
                                        <th style="text-align: center;">
                                            JENIS KELAMIN
                                        </th>
                                        <th style="text-align: center;">
                                            NO. TELP
                                        </th>
                                        <th style="text-align: center;">
                                            TTL
                                        </th>
                                        <th style="text-align: center;">
                                            TANGGAL DAFTAR
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($data) > 0) : ?>
                                    <?php $no=1; foreach ($data as $d) : ?>
                                    <tr>
                                        <td style="text-align: right;">
                                            <?php echo $no; ?>.
                                        </td>
                                        <td>
                                            <?php echo $d->ID_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->NM_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->JK_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->TELP_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->NM_KOTA.', '.date('d-m-Y', strtotime($d->TGL_LHR_PASIEN)); ?>
                                        </td>
                                        <td align="center">
                                            <?php echo date('d-m-Y', strtotime($d->TGL_DAFTAR)); ?>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                    <?php endforeach ?>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Maaf, tidak ada data yang ditampilkan.</td>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(!isset($cetak)): ?>
    <table border="0" width="100%" style="padding-top: 30px;">
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%" style="text-align: center;">
                Surabaya, <?php echo date('d-m-Y') ?><br><br><br><br><br>
                (_______________________)
            </td>
        </tr>
    </table>
    <?php endif ?>

    <?php if(isset($cetak)): ?>
    <hr>
    <form method="post" target="_blank" action="<?php echo $cetak; ?>">
        <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
        <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
        <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</button>
    </form>
    <?php endif ?>
</body>
</html>