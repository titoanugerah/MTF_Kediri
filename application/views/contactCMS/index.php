<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Kelola Konten Kontak</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <!-- <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewFamilyStatusForm()">Tambah Status Keluarga Baru</button> -->
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2">
    <div class="col-md-12">
      <div class="row">
        <div class="card full-height  col-md-12">
          <div class="page-navs bg-white">
            <div class="nav-scroller">
              <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
                <a class="nav-link active show" data-toggle="tab" href="#tab1">Konten</a>
                <a class="nav-link" data-toggle="tab" href="#tab2">Gambar</a>
              </div>
            </div>
          </div>
          <div class="tab-content mt-2 mb-3" >
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-4">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="name" value="">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" value="">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" value="">
                  </div>

                  <div class="form-group col-md-12">
                    <label>Alamat</label>
                    <textarea class="form-control" id="address" rows="2"></textarea>
                  </div>
                </div>
                <button class="btn btn-success" onclick="updateContent()">Simpan</button>
              </div>
          </div>
          <div class="tab-pane fade show" id="tab2" role="tabpanel" >
            <div class="input-file input-file-image">
              <img class="img-upload-preview" width="1000" src="http://placehold.it/1000x300" alt="preview" id="image">
              <input type="file" class="form-control form-control-file" id="fileUpload" name="fileUpload" accept="image/*" required="">
              <label for="fileUpload" class="  label-input-file btn btn-success">
                <span class="btn-label btn-info"><i class="fa fa-file-image"></i></span>Pilih Foto
              </label>
              <button class="btn btn-success" onclick="upload()">Upload Foto</button>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
  </div>
</div>
