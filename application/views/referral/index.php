<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Kelola Maping Referral</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0 row">
        <button type="button" data-toggle="modal" data-target="#uploadExcelForm" class="btn btn-white btn-border btn-round mr-2" >Upload Excel</button>
        <select class="form-control select2modal" id="period" style="width:150px;">
        </select>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2">
    <div class="col-md-12">
      <div class="row">
        <div class="card full-height  col-md-12">
          <div class="card-body">          
            <table id="referralTable" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Cabang</th>
                  <th>Kelas</th>
                  <th>Prospect</th>
                  <th>Go Live</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody id="referralData">
              </tbody>
            </table>
          </div>
        </div>
       </div>
      </div>
     </div>
   </div>
  </div>
</div>

<div class="modal fade" id="uploadExcelForm" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Upload Excel</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-12">
            <label>Bulan</label>
            <input type="month" class="form-control" id="date" required>
          </div>
          <div class="form-group">
            <label class="">Upload File</label>
            <div class="file-field">
              <div class="btn btn-primary btn-sm float-left">
                <span>Choose file</span>
                <input type="file" id="fileUpload1">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="upload()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>
    </div>
  </div>
</div>