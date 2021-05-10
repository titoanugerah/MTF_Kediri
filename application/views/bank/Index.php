<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Bank </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewBankForm()">Tambah Bank Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="bankList">

  </div>
</div>

<div class="modal fade" id="addBankModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Bank</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addNewTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Tambah Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#recoverTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewTab">

            <div class="col-md-12">
              <div class="row">
                <div class="form-group  col-md-3">
                <label>Nama Bank</label>
                <input type="text" class="form-control" id="addShortName" required>
              </div>
              <div class="form-group  col-md-9">
                <label>Nama Perusahaan</label>
                <input type="text" class="form-control" id="addFullName" required>
              </div>
              <div class="form-group col-md-12">
                <label>Email</label>
                <input type="email" class="form-control" id="addEmail" required>
              </div>
            </div>
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addBank()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>

          </div>
          <div class="tab-pane" id="recoverTab">
            <div class="form-group">
              <label>Bank</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverBankId" style="width:360px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverBank()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailBankModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Bank</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <div class="col-md-12">
          <div class="row">
            <div class="form-group  col-md-3">
              <label>Nama Bank</label>
              <input type="text" class="form-control" id="editShortName" required>
              <input type="text" class="form-control" id="editId" hidden>
            </div>
            <div class="form-group  col-md-9">
              <label>Nama Perusahaan</label>
              <input type="text" class="form-control" id="editFullName" required>
            </div>
            <div class="form-group col-md-12">
              <label>Email</label>
              <input type="email" class="form-control" id="editEmail" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deleteBank()">Hapus</button>
          <button type="button" class="btn btn-primary" onclick="updateBank()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
