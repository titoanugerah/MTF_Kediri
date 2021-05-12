<li class="nav-item active" >
  <a href="<?php echo base_url('dashboard'); ?>">
    <i class="fas fa-home"></i>
    <p>Dashboard</p>
  </a>
</li>

<li class="nav-item submenu active" >
  <a data-toggle="collapse" href="#cms" aria-expanded="false">
    <i class="fas fa-edit"></i>
    <p>Kelola Konten</p>
    <span class="caret"></span>
  </a>

  
  <div id="cms" class="collapse">
    <ul class="nav nav-collapse">
      <a href="<?php echo base_url('homeCMS'); ?>">
        <i class="fas fa-user-tag"></i>
        <p>Beranda</p>
      </a>

      <a href="<?php echo base_url('termsCMS'); ?>">
        <i class="fas fa-building"></i>
        <p>Syarat & Ketentuan</p>
      </a>

      <a href="<?php echo base_url('productCMS'); ?>">
        <i class="fas fa-map-marked"></i>
        <p>Produk</p>
      </a>

      <a href="<?php echo base_url('contactCMS'); ?>">
        <i class="fas fa-building"></i>
        <p>Kontak</p>
      </a>

      <a href="<?php echo base_url('otherPageCMS'); ?>">
        <i class="fas fa-users"></i>
        <p>Halaman Lainnya</p>
      </a>

    </ul>
  </div>

</li>

<li class="nav-item active" >
  <a href="<?php echo base_url('referral'); ?>">
    <i class="fas fa-edit"></i>
    <p>Mapping Referral</p>
  </a>
</li>

<li class="nav-item active" >
  <a href="<?php echo base_url('mtfMember'); ?>">
    <i class="fas fa-edit"></i>
    <p>Member WIRA</p>
  </a>
</li>
