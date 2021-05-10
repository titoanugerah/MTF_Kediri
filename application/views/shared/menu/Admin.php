<li class="nav-item active" >
  <a href="<?php echo base_url('dashboard'); ?>">
    <i class="fas fa-home"></i>
    <p>Dashboard</p>
  </a>
</li>

<li class="nav-item submenu active" >
  <a data-toggle="collapse" href="#masterSetting" aria-expanded="false">
    <i class="fas fa-address-book"></i>
    <p>Master Data</p>
    <span class="caret"></span>
  </a>

  
  <div id="masterSetting" class="collapse">
    <ul class="nav nav-collapse">
      <a href="<?php echo base_url('role'); ?>">
        <i class="fas fa-user-tag"></i>
        <p>Hak Akses</p>
      </a>

      <a href="<?php echo base_url('bank'); ?>">
        <i class="fas fa-building"></i>
        <p>Bank</p>
      </a>

      <a href="<?php echo base_url('area'); ?>">
        <i class="fas fa-map-marked"></i>
        <p>Area</p>
      </a>

      <a href="<?php echo base_url('district'); ?>">
        <i class="fas fa-building"></i>
        <p>Distrik</p>
      </a>

      <a href="<?php echo base_url('familyStatus'); ?>">
        <i class="fas fa-users"></i>
        <p>Status Keluarga</p>
      </a>

      <a href="<?php echo base_url('position'); ?>">
        <i class="fas fa-edit"></i>
        <p>Posisi</p>
      </a>

      <a href="<?php echo base_url('customer'); ?>">
        <i class="fas fa-chalkboard-teacher"></i>
        <p>Customer</p>
      </a>

      <a href="<?php echo base_url('employee'); ?>">
        <i class="fas fa-user"></i>
        <p>Pekerja</p>
      </a>
    </ul>
  </div>

</li>

<li class="nav-item active" >
  <a href="<?php echo base_url('payrollPeriod'); ?>">
    <i class="fas fa-money-bill-wave"></i>
    <p>Penggajian</p>
  </a>
</li>
