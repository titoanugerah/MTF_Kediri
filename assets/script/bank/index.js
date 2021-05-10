$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailBankModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addBankModal')
  });
  getBank();
});

function detailBankForm(id) {
  $("#detailBankModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/bank/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editShortName').val(result.detail.shortName);
      $('#editFullName').val(result.detail.fullName);
      $('#editEmail').val(result.detail.email);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getBank();
  $("#keyword").val();
})

function updateBank(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       shortName : $("#editShortName").val(),
       fullName : $('#editFullName').val(),
       email : $('#editEmail').val(),
    },
    url: "api/bank/update",
    success: function(result) {
      $("#detailBankModal").modal('hide');
      getBank();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewBankForm() {
  $('#keyword').val("");
  getBank();
  $("#addBankModal").modal('show');
}

function addBank() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      shortName : $("#addShortName").val(),
      fullName : $('#addFullName').val(),
      email : $('#addEmail').val(),
    },
    url: "api/bank/create",
    success: function(result) {
      $("#addBankModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getBank();
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

function  getBank(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/bank/read",
    success: function(result) {
      var html = "";
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.bank.forEach(bank => {
        if(bank.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailBankForm('+bank.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-4">' +
                      '<div class="icon-big text-center">' +
                        '<i class="flaticon-store"></i>' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-8 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-category">Bank</p>' +
                        '<h4 class="card-title">' + bank.shortName +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+bank.id+'"> '+bank.shortName+' </option>';
        }
      });

      $('#bankList').html(html);
      $('#recoverBankId').html(html1);
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

function deleteBank() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/bank/delete",
    success: function(result) {
      $("#detailBankModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getBank();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverBank() {
  if($('#recoverBankId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverBankId").val(),
      },
      url: "api/bank/recover",
      success: function(result) {
        $("#addBankModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getBank();
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
