$(document).ready(function(){
    $('.select2modal').select2({
        dropdownParent: $('#detailEmployeeModal')
    });
    $('.selectadd2modal').select2({
        dropdownParent: $('#addEmployeeModal')
    });
    getEmployee();
    getRole();
    getBank();
    getFamilyStatus();
    getPosition();
    getCustomer();
    getDistrict();
  });


  function getEmployee(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : $("#keyword").val(),
      },
      url: "api/employee/read",
      success: function(result) {
        console.log(result);
        var html1='';
        var html2='';
        var image = '';
        result.employee.forEach(function(data){        
          if (data.image==null) {
            image = 'assets/picture/employee.jpg';
          } else {
            image = data.image;
          }
          if (data.isExist==1) {
            html1 +=
            '<div class="col-sm-6 col-lg-3">' +
            '<div class="card">' +
            '<div class="p-2">' +
            '<img class="card-img-top rounded" src="'+image+'" style="max-height:200px;">' +
            '</div>' +
            '<div class="card-body pt-2">' +
            '<h4 class="mb-1 fw-bold">' +
            data.name +
            '</h4>' +
            '<br>' +
            '<center>' +
            '<button type="button" class="btn btn-secondary btn-round" onclick="detailEmployeeForm('+data.nik+')">Detail</button>'+
            '</center>' +
            '</div>' +
            '</div>' +
            '</div>';
          } else {
            html2 = html2 + '<option value="'+data.nik+'" selected>'+data.name+' ( '+data.email+ ' )</option>';
          }
        
        });
        $('#employeeList').html(html1);
        $('#recoverEmployeeId').html(html2);
    },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  
  }


  function  getRole(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : $("#keyword").val(),
      },
      url: "api/role/read",
      success: function(result) {
        var html = '<option value="0"> Silahkan pilih </option>';
        result.role.forEach(role => {
          if(role.isExist == 1){
            html = html +
            '<option value="'+role.id+'"> '+uppercase(role.name)+' </option>';
          } else {
            return;
          }
        });
  
        $('#addRoleId').html(html);
        $('#editRoleId').html(html);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

  function  getBank(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : '',
      },
      url: "api/bank/read",
      success: function(result) {
        var html = '<option value="0"> Silahkan pilih </option>';
        result.bank.forEach(bank => {
          if(bank.isExist == 1){
            html = html +
            '<option value="'+bank.id+'"> '+uppercase(bank.shortName)+' </option>';
          } else {
            return;
          }
        });
  
        $('#addBankId').html(html);
        $('#editBankId').html(html);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

  function  getFamilyStatus(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : '',
      },
      url: "api/familyStatus/read",
      success: function(result) {
        var html = '<option value="0"> Silahkan pilih </option>';
        result.familyStatus.forEach(familyStatus => {
          if(familyStatus.isExist == 1){
            html = html +
            '<option value="'+familyStatus.id+'"> '+uppercase(familyStatus.name)+' </option>';
          } else {
            return;
          }
        });
  
        $('#addFamilyStatusId').html(html);
        $('#editFamilyStatusId').html(html);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

  function  getCustomer(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : '',
      },
      url: "api/customer/read",
      success: function(result) {
        var html = '<option value="0"> Silahkan pilih </option>';
        result.customer.forEach(customer => {
          if(customer.isExist == 1){
            html = html +
            '<option value="'+customer.id+'"> '+uppercase(customer.name)+' </option>';
          } else {
            return;
          }
        });
  
        $('#addCustomerId').html(html);
        $('#editCustomerId').html(html);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

  function  getPosition(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : '',
      },
      url: "api/position/read",
      success: function(result) {
        var html = '<option value="0"> Silahkan pilih </option>';
        result.position.forEach(position => {
          if(position.isExist == 1){
            html = html +
            '<option value="'+position.id+'"> '+uppercase(position.name)+' </option>';
          } else {
            return;
          }
        });
  
        $('#addPositionId').html(html);
        $('#editPositionId').html(html);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

  function getDetailEmployee(nik){
    $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
           nik : nik,
        },
        url: "api/employee/readDetail",
        success: function(result) {
           console.log(result);
          $('#editNIK').val(result.detail.nik);
          $('#editName').val(result.detail.name);
          $('#editEmail').val(result.detail.email);
          $("#editRoleId").val(result.detail.roleId).change();
          $("#editFamilyStatusId").val(result.detail.familyStatusId).change();
          $("#editDistrictId").val(result.detail.districtId).change();
          $("#editIsRegisteredBpjs").val(result.detail.isRegisteredBpjs).change();
          $("#editBankId").val(result.detail.bankId).change();
          $("#editPositionId").val(result.detail.positionId).change();
          $("#editCustomerId").val(result.detail.customerId).change();
          $("#editAccountNumber").val(result.detail.accountNumber);
          $("#editStartContract").val(result.detail.startContract);
          $("#editEndContract").val(result.detail.endContract);
          $("#editPhoneInsentive").val(result.detail.phoneInsentive);
          
        },
        error: function(result) {
          console.log(result);
          notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
        }
      });
  }

  function detailEmployeeForm(nik) {
    $("#detailEmployeeModal").modal('show');
    getDetailEmployee(nik);
  
  }
  
  $("#keyword").on('change', function(){
    getEmployee();
    $("#keyword").val();
  });
  
  function updateEmployee(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         nik : $("#editNIK").val(),
         email : $("#editEmail").val(),
         name : $("#editName").val(),
         roleId : $("#editRoleId").val(),
         positionId : $("#editPositionId").val(),
         customerId : $("#editCustomerId").val(),
         familyStatusId : $("#editFamilyStatusId").val(),
         districtId : $("#editDistrictId").val(),
         bankId : $("#editBankId").val(),
         accountNumber : $("#editAccountNumber").val(),
         isRegisteredBpjs : $("#editIsRegisteredBpjs").val(),
         phoneInsentive : $("#editPhoneInsentive").val(),
         startContract : $("#editStartContract").val(),
         endContract : $("#editEndContract").val(),
      },
      url: "api/employee/update",
      success: function(result) {
        $("#detailEmployeeModal").modal('hide');
        getEmployee();
        notify('fas fa-check', 'Berhasil', result.content, 'success');
      },
      error: function(result) {
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }

  function  getDistrict(){ 
    $.ajax({ 
      type: "POST", 
      dataType : "JSON", 
      data : { 
      keyword : '', 
    }, 
    url: "api/district/read", 
    success: function(result) { 
      var html1 = '<option value="0"> Silahkan pilih </option>'; 
      result.district.forEach(district => 
      {
        html1 = html1 + 
          '<option value="'+district.id+'"> '+uppercase(district.name)+' </option>';   
      }); 
      $('#addDistrictId').html(html1);   
      $('#editDistrictId').html(html1); 
    }, 
    error: function(result) { 
      console.log("Error", result); 
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger'); 
    } 
  }); 
} 
  
  function addNewEmployeeForm() {
    $('#keyword').val("");
    getRole();
    getEmployee();
    $("#addEmployeeModal").modal('show');
  }
  
  function addEmployee() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        nik : $("#addNIK").val(),
        email : $("#addEmail").val(),
        name : $("#addName").val(),
        roleId : $("#addRoleId").val(),
        positionId : $("#addPositionId").val(),
        customerId : $("#addCustomerId").val(),
        familyStatusId : $("#addFamilyStatusId").val(),
        districtId : $("#addDistrictId").val(),
        bankId : $("#addBankId").val(),
        accountNumber : $("#addAccountNumber").val(),
        isRegisteredBpjs : $("#addIsRegisteredBpjs").val(),
        phoneInsentive : $("#addPhoneInsentive").val(),
        startContract : $("#addStartContract").val(),
        endContract : $("#addEndContract").val(),
      },
      url: "api/employee/create",
      success: function(result) {
        $("#addEmployeeModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getEmployee();
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
  
  function getErrorMsg(result){
    var responseInArray = result.split('\n');
    for(var i=0; i < responseInArray.length; i++) {
      responseInArray[i] = responseInArray[i].replace(/ +(?= )/g,'');
      responseInArray[i] = responseInArray[i].replace('\t','');
      responseInArray[i] = responseInArray[i].replace('\t','');
      responseInArray[i] = responseInArray[i].replace('<h1>','');
      responseInArray[i] = responseInArray[i].replace('</h1>','');
      responseInArray[i] = responseInArray[i].replace('<div>','');
      responseInArray[i] = responseInArray[i].replace('</div>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
     }
  
     var error = responseInArray.filter(x => (x.includes("Message")));
     if(error.length == 0){
       error = responseInArray.filter(x => (x.includes("Error ")));
     }
    return error.toString();  
  }
  
  function uppercase(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
  
  function deleteEmployee() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         nik : $("#editId").val(),
      },
      url: "api/employee/delete",
      success: function(result) {
        $("#detailEmployeeModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getEmployee();
      },
      error: function(result) {
        console.log(result);
         notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
  
  function recoverEmployee() {
    if($('#recoverEmployeeId').val()!=0)
    {
      $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
          nik : $("#recoverEmployeeId").val(),
        },
        url: "api/employee/recover",
        success: function(result) {
          $("#addEmployeeModal").modal('hide');
          notify('fas fa-check', 'Berhasil', result.content, 'success');
          getEmployee();
        },
        error: function(result) {
          notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
        }
      });
  
    } else {
      notify('fas fa-bell', 'Gagal', 'Mohon pilih dengan benar', 'danger');
    }
  }
  
  function unauthorized() {
    notify('fas fa-employee', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
  }
  