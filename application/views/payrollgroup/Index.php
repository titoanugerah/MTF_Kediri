<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Periode Penggajian <?php echo $period->month.' '.$period->year; ?></h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <input type="text" id="id" value="<?php echo $period->id; ?>" hidden>
        <!-- <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewPayrollPeriod()">Tambah Periode Penggajian Baru</button> -->
        <button type="button" class="btn btn-white btn-border btn-round mr-2" data-toggle="modal" data-target="#uploadExcelModal" >Upload Excel</button>
      </div>
    </div>
  </div>
  
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2">
    <div class="card full-height col-md-12">
      <div class="card-body">    
        <table  class="display datatable" id="payrollGroupTable">

        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <p>Silahkan upload dokumen excel yang sudah dilengkapi</p>
          <div class="file-field">
            <div class="btn btn-primary btn-sm float-left">
              <span>Choose file</span>
              <input type="file" name="fileUpload">
            </div>
          </div>
        </div>
        <br>
        <br>
        <div class="modal-footer modal-danger">
          <button type="submit" class="btn btn-warning" name="uploadExcel" value="uploadExcel">Upload</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>