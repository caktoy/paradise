<?php if (count($data) > 0): ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <div style="display: block;width: 100%;text-align: center;font-weigth: bold;font-size: 14pt;padding-bottom: 40px;">
                    <h3><?php echo $judul; ?></h3>
                </div>
            </div>
            <!--Body Content-->
            <div class="box-body">
                <table border="0" cellpadding="2" cellspacing="2" width="100%">
                    <tr>
                        <td><strong>#Pasien</strong></td>
                        <td>:</td>
                        <td><?php echo $data[0]->ID_PASIEN; ?></td>

                        <td><strong>Tempat, Tanggal Lahir</strong></td>
                        <td>:</td>
                        <td><?php echo $data[0]->TMPT_LHR_PASIEN.', '.date('d/m/Y', strtotime($data[0]->TGL_LHR_PASIEN)); ?></td>
                    </tr>

                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>:</td>
                        <td><?php echo $data[0]->NM_PASIEN; ?></td>

                        <td><strong>Alamat</strong></td>
                        <td>:</td>
                        <td><?php echo $data[0]->ALMT_PASIEN; ?></td>
                    </tr>
                </table>
                <hr>
                <table border="0" cellpadding="2" cellspacing="2" width="50%">
                    <tr>
                        <td><strong>Poli</strong> &nbsp; &nbsp;</td>
                        <td>:</td>
                        <td><?php echo $data[0]->NM_POLI ?></td>
                    </tr>
                    <tr>
                        <td><strong>Dokter</strong> &nbsp; &nbsp;</td>
                        <td>:</td>
                        <td><?php echo $data[0]->NM_DOKTER ?></td>
                    </tr>
                </table>
                <hr><br>
                
                <fieldset>
                    <legend>Keluhan</legend>
                    <div style="font-style: italic;"><?php echo $data[0]->ANAMNESIS ?></div>
                </fieldset>

                <?php if (count($diagnosis) > 0): ?>
                <fieldset>
                    <legend>Diagnosis</legend>
                    <div>
                        <?php print_r($diagnosis); ?>
                    </div>
                </fieldset>
                <?php endif ?>
                
                <?php if (count($terapi) > 0): ?>
                <fieldset>
                    <legend>Terapi</legend>
                    <div><?php print_r($terapi) ?></div>
                </fieldset>
                <?php endif ?>

                <?php if (count($tindakan) > 0): ?>
                <fieldset>
                    <legend>Tindakan</legend>
                    <div><?php print_r($tindakan) ?></div>
                </fieldset>
                <?php endif ?>

                <?php if (count($lab) > 0): ?>
                <fieldset>
                    <legend>Lab</legend>
                    <div><?php print_r($lab) ?></div>
                </fieldset>
                <?php endif ?>

                <?php if (count($resep_obat) > 0): ?>
                <fieldset>
                    <legend>Resep Obat</legend>
                    <div><?php print_r($resep_obat) ?></div>
                </fieldset>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

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
<form method="post" action="<?php echo $cetak; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</button>
</form>
<?php endif ?>