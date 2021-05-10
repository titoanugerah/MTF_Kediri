<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Profil</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row mt--2">
    <div class="col-md-12">
      <div class="row">

      <div class="card full-height  col-md-9">
        <div class="card-header">
          <div class="card-title">Identitas Pekerja</div>
          <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">

          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-3">
                <label>NIK</label>
                <input type="text" class="form-control" id="nik" value="<?php echo $this->session->userdata['nik'] ?>">
              </div>

              <div class="form-group col-md-5">
                <label>Nama Pengguna</label>
                <input type="text" class="form-control" id="name" value="<?php echo $this->session->userdata['name'] ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="email" class="form-control" id="email" value="<?php echo $this->session->userdata['email'] ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Customer</label>
                <input type="text" class="form-control" id="customer" value="<?php echo $this->session->userdata['customer'] ?>">
              </div>
              <div class="form-group col-md-2">
                <label>Posisi</label>
                <input type="text" class="form-control" id="position" value="<?php echo $this->session->userdata['position'] ?>">
              </div>
              <div class="form-group col-md-3">
                <label>Area</label>
                <input type="text" class="form-control" id="area" value="<?php echo $this->session->userdata['area'] ?>">
              </div>
              <div class="form-group col-md-3">
                <label>Distrik</label>
                <input type="text" class="form-control" id="district" value="<?php echo $this->session->userdata['district'] ?>">
              </div>
              <div class="form-group col-md-2">
                <label>Bank</label>
                <input type="text" class="form-control" id="bank" value="<?php echo $this->session->userdata['bank'] ?>">
              </div>
              <div class="form-group col-md-3">
                <label>Nomor Rekening</label>
                <input type="text" class="form-control" id="accountNumber" value="<?php echo $this->session->userdata['accountNumber'] ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Nama Rekening</label>
                <input type="text" class="form-control" id="accountName" value="<?php echo $this->session->userdata['name'] ?>">
              </div>
              <div class="form-group col-md-3">
                <label>Terdaftar BPJS/KIS</label>
                <input type="text" class="form-control" id="isRegisteredBpjs" value="<?php if($this->session->userdata['isRegisteredBpjs']){echo 'Terdaftar';} else {echo 'Tidak Terdaftar';} ?>">
              </div>

            </div>
            <br>

          </div>
        </div>
      </div>
      <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <center>
            Foto Profil
          </center>
        </div>
        <div class="card-body">
          <center>
            <div class="avatar avatar-xxl">
              <img src="<?php echo $this->session->userdata['image']; ?>" alt="..." class="avatar-img rounded-circle">
              <br><br>
            </div>
            <br>
            <?php echo $this->session->userdata('role'); ?><br>
            <p><?php echo $this->session->userdata('name'); ?></p>
          </center>
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>

</div>
