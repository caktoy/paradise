<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">PILIHAN MENU</li>
    <li class="<?php echo $aktif=='beranda'?'active':''; ?>">
      <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a>
    </li>

    <li class="<?php echo $aktif=='maintenance'?'active':''; ?> treeview" id="scrollspy-components">
      <a href="javascript::;"><i class="fa fa-check"></i> Maintenance</a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url().'poli'; ?>">Master Poli</a></li>
        <li><a href="<?php echo base_url().'dokter'; ?>">Master Dokter</a></li>
        <li><a href="<?php echo base_url().'jadwal_dokter'; ?>">Master Jadwal Dokter</a></li>
        <li><a href="<?php echo base_url().'perawat' ?>">Master Perawat</a></li>
        <li><a href="#">Master Diagnosis ICD 10</a></li>
        <li><a href="#">Master Tindakan ICD 9</a></li>
        <li><a href="#">Master Jenis Obat</a></li>
        <li><a href="#">Master Obat</a></li>
        <li><a href="#">Master Terapi</a></li>
        <li><a href="#">Master Pasien</a></li>
        <li><a href="#">Master Odontogram</a></li>
        <li><a href="#">Master Pemeriksaan Lab</a></li>
      </ul>
    </li>

    <li class="<?php echo $aktif=='transaksi'?'active':''; ?> treeview" id="scrollspy-components">
      <a href="javascript::;"><i class="fa fa-exchange"></i> Transaksi</a>
      <ul class="treeview-menu">
        <li><a href="#">Registrasi Pasien Baru</a></li>
        <li><a href="#">Registrasi Pemeriksaan</a></li>
        <li><a href="#">Display Antrian</a></li>
        <li><a href="#">Pencatatan Rekam Medis</a></li>
        <li><a href="#">Resep Obat</a></li>
        <li><a href="#">Pemeriksaan Lab</a></li>
        <li><a href="#">Pembayaran</a></li>
      </ul>
    </li>

    <li class="<?php echo $aktif=='laporan'?'active':''; ?> treeview" id="scrollspy-components">
      <a href="javascript::;"><i class="fa fa-paste"></i> Laporan</a>
      <ul class="treeview-menu">
        <li><a href="#">Laporan Kunjungan Pasien</a></li>
        <li><a href="#">Laporan Registrasi Pasien Baru</a></li>
        <li><a href="#">Laporan Penyakit Terbanyak</a></li>
        <li><a href="#">Laporan Rekam Medis Pasien</a></li>
        <li><a href="#">Laporan Pengeluaran Obat</a></li>
        <li><a href="#">Laporan Pendapatan</a></li>
      </ul>
    </li>
  </ul>
</section>