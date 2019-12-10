<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
  <div class="sidebar-brand-icon ">
    <img src="<?=base_url();?>assets/img/ASTRA.png" width="70px" height="50px">
  </div>
  <div class="sidebar-brand-text mx-1">SPK Wahid</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="<?=$this->session->userdata('jabatan') == 'admin' ? base_url('admin') : base_url('manager') ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Kriteria
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="<?=$this->session->userdata('jabatan') == 'admin' ? base_url('admin/kelola_kriteria') : base_url('manager/kriteria') ?>">
    <i class="fas fa-fw fa-list-ul"></i>
    <span><?=$this->session->userdata('jabatan') == 'admin' ? 'Kelola Kriteria' : 'Kriteria' ?></span></a>
</li>

<!-- Heading -->
<div class="sidebar-heading">
  Sub Kriteria
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="<?=$this->session->userdata('jabatan') == 'admin' ? base_url('admin/kelola_sub_kriteria') : base_url('manager/sub_kriteria') ?>">
    <i class="fas fa-fw fa-list-ul"></i>
    <span><?=$this->session->userdata('jabatan') == 'admin' ? 'Kelola Sub Kriteria' : 'Sub Kriteria' ?></span></a>
</li>

<!-- Heading -->
<div class="sidebar-heading">
  Alternatif
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="<?=$this->session->userdata('jabatan') == 'admin' ? base_url('admin/kelola_alternatif') : base_url('manager/alternatif') ?>">
    <i class="fas fa-fw fa-table"></i>
    <span><?=$this->session->userdata('jabatan') == 'admin' ? 'Kelola alternatif' : 'Alternatif' ?></span></a>
</li>

<!-- Heading -->
<div class="sidebar-heading">
  Perangkingan
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="<?=$this->session->userdata('jabatan') == 'admin' ? base_url('admin/perangkingan') : base_url('manager/rank') ?>">
    <i class="fas fa-fw fa-table"></i>
    <span><?=$this->session->userdata('jabatan') == 'admin' ? 'Perangkingan' : 'Hasil Rank' ?></span></a>
</li>


<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->