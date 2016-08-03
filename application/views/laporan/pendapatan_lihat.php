<!DOCTYPE html>
<html>
<head>
    <title><?php echo $judul ?></title>
</head>
<body <?php if(!isset($cetak)) { echo "onload='javascript:window.print();'"; } ?>>
    <div style="display: block;width: 100%;text-align: center;font-weigth: bold;font-size: 14pt;">
        <?php echo $judul; ?><br>
        <?php echo $subjudul; ?><br>
    </div>
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Pendapatan Tindakan</h4>
                            <table cellpadding="2" cellspacing="0" border="1" width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <th style="text-align: center;">
                                            NO
                                        </th>
                                        <th style="text-align: center;">
                                            REKAM MEDIS
                                        </th>
                                        <th style="text-align: center;">
                                            PASIEN
                                        </th>
                                        <th style="text-align: center;">
                                            TINDAKAN
                                        </th>
                                        <th style="text-align: center;">
                                            HARGA
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_tindakan = 0; 
                                    $total_lab = 0; 
                                    $total_terapi = 0; 
                                    $total_obat = 0; 
                                    ?>
                                    <?php if(count($data_tindakan) > 0) : ?>
                                    <?php $total_tindakan = 0; ?>
                                    <?php $no=1; foreach ($data_tindakan as $d) : ?>
                                    <tr>
                                        <td style="text-align: right;">
                                            <?php echo $no; ?>.
                                        </td>
                                        <td>
                                            <?php echo $d->ID_REKAM_MEDIS; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->ID_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->NM_ICD_9; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php echo "Rp".number_format($d->HARGA_TINDAKAN, 2, ",", "."); ?>
                                        </td>
                                    </tr>
                                    <?php $no++; $total_tindakan += $d->HARGA_TINDAKAN; ?>
                                    <?php endforeach ?>
                                    <tr style="font-weight: bold;">
                                        <td align="right" colspan="4">TOTAL</td>
                                        <td align="right"><?php echo "Rp".number_format($total_tindakan, 2, ",", ".") ?></td>
                                    </tr>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">Maaf, tidak ada data yang ditampilkan.</td>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>

                            <h4>Pendapatan Lab</h4>
                            <table cellpadding="2" cellspacing="0" border="1" width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <th style="text-align: center;">
                                            NO
                                        </th>
                                        <th style="text-align: center;">
                                            REKAM MEDIS
                                        </th>
                                        <th style="text-align: center;">
                                            PASIEN
                                        </th>
                                        <th style="text-align: center;">
                                            LAB
                                        </th>
                                        <th style="text-align: center;">
                                            HARGA
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($data_lab) > 0) : ?>
                                    <?php $total_lab = 0; ?>
                                    <?php $no=1; foreach ($data_lab as $d) : ?>
                                    <tr>
                                        <td style="text-align: right;">
                                            <?php echo $no; ?>.
                                        </td>
                                        <td>
                                            <?php echo $d->ID_REKAM_MEDIS; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->ID_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->LAB; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php echo "Rp".number_format($d->HARGA, 2, ",", "."); ?>
                                        </td>
                                    </tr>
                                    <?php $no++; $total_lab += $d->HARGA; ?>
                                    <?php endforeach ?>
                                    <tr style="font-weight: bold;">
                                        <td align="right" colspan="4">TOTAL</td>
                                        <td align="right"><?php echo "Rp".number_format($total_lab, 2, ",", ".") ?></td>
                                    </tr>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">Maaf, tidak ada data yang ditampilkan.</td>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>

                            <h4>Pendapatan Terapi</h4>
                            <table cellpadding="2" cellspacing="0" border="1" width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <th style="text-align: center;">
                                            NO
                                        </th>
                                        <th style="text-align: center;">
                                            REKAM MEDIS
                                        </th>
                                        <th style="text-align: center;">
                                            PASIEN
                                        </th>
                                        <th style="text-align: center;">
                                            TERAPI
                                        </th>
                                        <th style="text-align: center;">
                                            HARGA
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($data_terapi) > 0) : ?>
                                    <?php $total_terapi = 0; ?>
                                    <?php $no=1; foreach ($data_terapi as $d) : ?>
                                    <tr>
                                        <td style="text-align: right;">
                                            <?php echo $no; ?>.
                                        </td>
                                        <td>
                                            <?php echo $d->ID_REKAM_MEDIS; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->ID_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->NM_TERAPI; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php echo "Rp".number_format($d->HARGA_TERAPI, 2, ",", "."); ?>
                                        </td>
                                    </tr>
                                    <?php $no++; $total_terapi += $d->HARGA_TERAPI; ?>
                                    <?php endforeach ?>
                                    <tr style="font-weight: bold;">
                                        <td align="right" colspan="4">TOTAL</td>
                                        <td align="right"><?php echo "Rp".number_format($total_terapi, 2, ",", ".") ?></td>
                                    </tr>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Maaf, tidak ada data yang ditampilkan.</td>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>

                            <h4>Pendapatan Obat</h4>
                            <table cellpadding="2" cellspacing="0" border="1" width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <th style="text-align: center;">
                                            NO
                                        </th>
                                        <th style="text-align: center;">
                                            REKAM MEDIS
                                        </th>
                                        <th style="text-align: center;">
                                            PASIEN
                                        </th>
                                        <th style="text-align: center;">
                                            OBAT
                                        </th>
                                        <th style="text-align: center;">
                                            HARGA
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($data_obat) > 0) : ?>
                                    <?php $total_obat = 0; ?>
                                    <?php $no=1; foreach ($data_obat as $d) : ?>
                                    <tr>
                                        <td style="text-align: right;">
                                            <?php echo $no; ?>.
                                        </td>
                                        <td>
                                            <?php echo $d->ID_REKAM_MEDIS; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->ID_PASIEN; ?>
                                        </td>
                                        <td>
                                            <?php echo $d->NM_OBAT; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php echo "Rp".number_format($d->HRG_OBAT, 2, ",", "."); ?>
                                        </td>
                                    </tr>
                                    <?php $no++; $total_obat += $d->HRG_OBAT; ?>
                                    <?php endforeach ?>
                                    <tr style="font-weight: bold;">
                                        <td align="right" colspan="4">TOTAL</td>
                                        <td align="right"><?php echo "Rp".number_format($total_obat, 2, ",", ".") ?></td>
                                    </tr>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">Maaf, tidak ada data yang ditampilkan.</td>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>

                            <table cellpadding="2" cellspacing="0" border="1" width="100%" class="table table-striped table-bordered table-hover">
                                <tr style="font-size: 14pt;font-weight: bold;">
                                    <td align="right" colspan="4">TOTAL PENDAPATAN</td>
                                    <td align="right"><?php echo "Rp".number_format(($total_tindakan + $total_lab + $total_terapi + $total_obat), 2, ",", ".") ?></td>
                                </tr>
                            </table>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>