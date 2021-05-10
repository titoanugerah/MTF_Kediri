<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" id="departmentName">Pekerja </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewEmployeeForm()">Tambah Pekerja Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="employeeList">

  </div>
</div>

<div class="modal fade" id="addEmployeeModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Pekerja</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
            <li class="step" style="width: 50%;">
              <a class="nav-link active" href="#identityNewTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user mr-0"></i> Identitas</a>
            </li>
            <li class="step" style="width: 50%;">
              <a class="nav-link" href="#detailNewTab" data-toggle="tab"><i class="fas fa-list"></i> Detail </a>
            </li>
          </ul>
          <div class="tab-content">
          <div class="tab-pane active" id="identityNewTab">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>NIK</label>
                  <input type="text" class="form-control" id="addNIK" required>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Email Pekerja</label>
                  <input type="text" class="form-control" id="addEmail" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status Keluarga</label>
                  <br>
                  <select class="form-control selectadd2modal" id="addFamilyStatusId" style="width:150px;">

                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status BPJS / KIS</label>
                  <br>
                  <select class="form-control selectadd2modal" id="addIsRegisteredBpjs" style="width:150px">
                    <option value="0">Tidak Terdaftar</option>
                    <option value="1">Terdaftar</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Hak Akses</label>
                  <br>
                  <select class="form-control selectadd2modal" id="addRoleId" style="">

                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank</label>
                  <br>
                  <select class="form-control selectadd2modal" id="addBankId" style="width:150px">

                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Nomor Rekening</label>
                  <br>
                  <input type="text" class="form-control" id="addAccountNumber" >

                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="detailNewTab">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Customer</label>
                  <br>
                  <select class="form-control selectadd2modal" id="addCustomerId" style="width:150px;">

                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Posisi Pekerjaan</label>
                  <br>
                  <select class="form-control selectadd2modal" id="addPositionId" style="width:100px;">

                  </select>
                </div>
              </div>
              <div class="col-md-4"> 
                <div class="form-group"> 
                  <label>Distrik</label> 
                  <select class="form-control selectadd2modal" id="addDistrictId" style="width:150px;">

                  </select>

                </div> 
              </div> 
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mulai Kontrak</label>
                  <br>
                  <input type="date" class="form-control" id="addStartContract" >

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Akhir Kontrak</label>
                  <br>
                  <input type="date" class="form-control" id="addEndContract" >

                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Insentif Pulsa</label>
                  <br>
                  <input type="text" class="form-control" id="addPhoneInsentive" >

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="addEmployee()">Tambah Pekerja</button>
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
          </div>



        </div>


      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailEmployeeModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Pekerja</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#identityTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user mr-0"></i> Identitas</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#detailTab" data-toggle="tab"><i class="fas fa-list"></i> Detail </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="identityTab">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>NIK</label>
                  <input type="text" class="form-control" id="editNIK" disabled>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Nama Pekerja</label>
                  <input type="text" class="form-control" id="editName" >
                  <!-- <input type="text" class="form-control" id="editId" hidden> -->
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Email Pekerja</label>
                  <input type="text" class="form-control" id="editEmail" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status Keluarga</label>
                  <br>
                  <select class="form-control select2modal" id="editFamilyStatusId" style="width:150px;">

                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status BPJS / KIS</label>
                  <br>
                  <select class="form-control select2modal" id="editIsRegisteredBpjs" style="width:150px">
                    <option value="0">Tidak Terdaftar</option>
                    <option value="1">Terdaftar</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Hak Akses</label>
                  <br>
                  <select class="form-control select2modal" id="editRoleId" style="">

                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank</label>
                  <br>
                  <select class="form-control select2modal" id="editBankId" style="width:150px">

                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Nomor Rekening</label>
                  <br>
                  <input type="text" class="form-control" id="editAccountNumber" >

                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="detailTab">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Customer</label>
                  <br>
                  <select class="form-control select2modal" id="editCustomerId" style="width:150px;">

                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Posisi Pekerjaan</label>
                  <br>
                  <select class="form-control select2modal" id="editPositionId" style="width:100px;">

                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Distrik</label>
                  <br>
                  <select class="form-control select2modal" id="editDistrictId" style="width:150px;">

                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mulai Kontrak</label>
                  <br>
                  <input type="date" class="form-control" id="editStartContract" >

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Akhir Kontrak</label>
                  <br>
                  <input type="date" class="form-control" id="editEndContract" >

                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Insentif Pulsa</label>
                  <br>
                  <input type="text" class="form-control" id="editPhoneInsentive" >

                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deleteEmployee()">Hapus</button>
          <button type="button" class="btn btn-primary" onclick="updateEmployee()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
