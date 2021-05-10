<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Posisi Pekerjaan </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewPositionForm()">Tambah Posisi Pekerjaan Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="positionList">

  </div>
</div>

<div class="modal fade" id="addPositionModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Posisi Pekerjaan</h4>
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
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Posisi Pekerjaan</label>
                  <input type="text" class="form-control" id="addName" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Insentif</label>
                  <input type="text" class="form-control" id="addInsentive" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Premi</label>
                  <input type="text" class="form-control" id="addPremium" required>
                </div>
              </div>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addPosition()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>

          </div>
          <div class="tab-pane" id="recoverTab">
            <div class="form-group">
              <label>Position</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverPositionId" style="width:360px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverPosition()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailPositionModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Posisi Pekerjaan</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <div class="row">        
          <div class="col-md-12">
            <div class="form-group">
              <label>Nama Posisi Pekerjaan</label>
              <input type="text" class="form-control" id="editName" required>
              <input type="text" class="form-control" id="editId" hidden>
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Insentif</label>
                <input type="text" class="form-control" id="editInsentive" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Premi</label>
                <input type="text" class="form-control" id="editPremium" required>
              </div>
            </div>  
          </div>  
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deletePosition()">Hapus</button>
          <button type="button" class="btn btn-primary" onclick="updatePosition()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
