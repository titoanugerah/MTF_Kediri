$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailCustomerModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addCustomerModal')
  });
  getCustomer();
});

function detailCustomerForm(id) {
  $("#detailCustomerModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/customer/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editPicName').val(result.detail.picName);
      $('#editPicEmail').val(result.detail.picEmail);
      $('#editPicPhone').val(result.detail.picPhone);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getCustomer();
  $("#keyword").val();
})

function updateCustomer(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       picName : $("#editName").val(),
       picPhone : $('#editPicPhone').val(),
       picEmail : $('#editPicEmail').val(),
    },
    url: "api/customer/update",
    success: function(result) {
      $("#detailCustomerModal").modal('hide');
      getCustomer();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewCustomerForm() {
  $('#keyword').val("");
  getCustomer();
  $("#addCustomerModal").modal('show');
}

function addCustomer() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       picName : $("#addName").val(),
       picPhone : $('#addPicPhone').val(),
       picEmail : $('#addPicEmail').val(),
      },
    url: "api/customer/create",
    success: function(result) {
      $("#addCustomerModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getCustomer();
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

function  getCustomer(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/customer/read",
    success: function(result) {
      var html = "";
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.customer.forEach(customer => {
        if(customer.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailCustomerForm('+customer.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-12 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-category"> Customer </p>' +
                        '<h4 class="card-title">' + uppercase(customer.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+customer.id+'"> '+uppercase(customer.name)+' </option>';
        }
      });

      $('#customerList').html(html);
      $('#recoverCustomerId').html(html1);
    },
    error: function(result) {
      console.log("Error", result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
 });

}

function uppercase(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function deleteCustomer() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/customer/delete",
    success: function(result) {
      $("#detailCustomerModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getCustomer();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverCustomer() {
  if($('#recoverCustomerId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverCustomerId").val(),
      },
      url: "api/customer/recover",
      success: function(result) {
        $("#addCustomerModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getCustomer();
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
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
