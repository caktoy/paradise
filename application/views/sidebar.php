<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">PILIHAN MENU</li>
    <li class="<?php echo $aktif=='beranda'?'active':''; ?>">
      <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a>
    </li>
    <?php if ($_SESSION['userrole'] == 'Administrasi'): ?>
    <li class="<?php echo $aktif=='maintenance'?'active':''; ?> treeview" id="scrollspy-components">
      <a href="javascript:;"><i class="fa fa-check"></i> Maintenance</a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url().'kota'; ?>">Master Kota</a></li>
        <li><a href="<?php echo base_url().'poli'; ?>">Master Poli</a></li>
        <li><a href="<?php echo base_url().'dokter'; ?>">Master Dokter</a></li>
        <li><a href="<?php echo base_url().'jadwal_dokter'; ?>">Master Jadwal Dokter</a></li>
        <li><a href="<?php echo base_url().'perawat' ?>">Master Perawat</a></li>
        <li><a href="<?php echo base_url().'diagnosis_icd_10'; ?>">Master Diagnosis (ICD 10)</a></li>
        <li><a href="<?php echo base_url().'tindakan_icd_9'; ?>">Master Tindakan (ICD 9)</a></li>
        <li><a href="<?php echo base_url().'jenis_obat' ?>">Master Jenis Obat</a></li>
        <li><a href="<?php echo base_url().'obat' ?>">Master Obat</a></li>
        <li><a href="<?php echo base_url().'terapi' ?>">Master Terapi</a></li>
        <li>
          <a href="javascript:;">Master Lab</a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'jenis_lab' ?>">Master Jenis Lab</a></li>
            <li><a href="<?php echo base_url().'pemeriksaan_lab' ?>">Master Pemeriksaan Lab</a></li>
          </ul>
        </li>
        <li>
          <a href="javascript:;">Master Odontogram</a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'status_gigi' ?>">Master Status Gigi</a></li>
            <li><a href="<?php echo base_url().'nomenklatur' ?>">Master Nomenklatur</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url().'pasien' ?>">Master Pasien</a></li>
      </ul>
    </li>
    <?php endif ?>

    <li class="<?php echo $aktif=='transaksi'?'active':''; ?> treeview" id="scrollspy-components">
      <a href="javascript:;"><i class="fa fa-exchange"></i> Transaksi</a>
      <ul class="treeview-menu">
        <?php if ($_SESSION['userrole'] == 'Administrasi'): ?>
        <li><a href="<?php echo base_url().'registrasi_pemeriksaan' ?>">Registrasi Pemeriksaan</a></li>
        <li><a href="<?php echo base_url().'antrian/display' ?>" target="_blank">Display Antrian</a></li>
        <?php endif ?>
        <?php if ($_SESSION['userrole'] == 'Dokter'): ?>
        <li><a href="<?php echo base_url().'rekam_medis' ?>">Pencatatan Rekam Medis</a></li>
        <li><a href="<?php echo base_url().'pasien/cari' ?>">Pencarian Data Pasien</a></li>
        <?php endif ?>
        <!-- <li><a href="<?php echo base_url().'resep_obat' ?>">Resep Obat</a></li> -->
        <?php if ($_SESSION['userrole'] == 'Laboratorium'): ?>
        <li><a href="<?php echo base_url().'pemeriksaan_lab/transaksi' ?>">Pemeriksaan Lab</a></li>
        <?php endif ?>
        <?php if ($_SESSION['userrole'] == 'Kasir/Apotik'): ?>
        <li><a href="<?php echo base_url().'pembayaran' ?>">Pembayaran</a></li>
        <?php endif ?>
      </ul>
    </li>

    <?php if ($_SESSION['userrole'] != 'Laboratorium'): ?>
    <li class="<?php echo $aktif=='laporan'?'active':''; ?> treeview" id="scrollspy-components">
      <a href="javascript:;"><i class="fa fa-paste"></i> Laporan</a>
      <ul class="treeview-menu">
        <?php if ($_SESSION['userrole'] == 'Administrasi'): ?>
        <li><a href="<?php echo base_url().'laporan/kunjungan_pasien'; ?>">Laporan Kunjungan Pasien</a></li>
        <li><a href="<?php echo base_url().'laporan/registrasi_pasien'; ?>">Laporan Registrasi Pasien Baru</a></li>
        <?php endif ?>
        <?php if ($_SESSION['userrole'] == 'Dokter'): ?>
        <li><a href="<?php echo base_url().'laporan/penyakit_terbanyak'; ?>">Laporan Penyakit Terbanyak</a></li>
        <li><a href="<?php echo base_url().'laporan/kunjungan_per_dokter'; ?>">Laporan Kunjungan per Dokter</a></li>
        <?php endif ?>
        <?php if ($_SESSION['userrole'] == 'Kasir/Apotik'): ?>
        <li><a href="<?php echo base_url().'laporan/pengeluaran_obat'; ?>">Laporan Pengeluaran Obat</a></li>
        <li><a href="<?php echo base_url().'laporan/pendapatan'; ?>">Laporan Pendapatan</a></li>
        <?php endif ?>
      </ul>
    </li>
    <?php endif ?>
  </ul>
</section>