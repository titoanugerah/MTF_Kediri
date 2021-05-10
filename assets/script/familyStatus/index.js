$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailFamilyStatusModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addFamilyStatusModal')
  });
  getFamilyStatus();
});

function detailFamilyStatusForm(id) {
  $("#detailFamilyStatusModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/familyStatus/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editLimitIncome').val(result.detail.limitIncome);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getFamilyStatus();
  $("#keyword").val();
})

function updateFamilyStatus(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       limitIncome : $('#editLimitIncome').val()
    },
    url: "api/familyStatus/update",
    success: function(result) {
      $("#detailFamilyStatusModal").modal('hide');
      getFamilyStatus();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewFamilyStatusForm() {
  $('#keyword').val("");
  getFamilyStatus();
  $("#addFamilyStatusModal").modal('show');
}

function addFamilyStatus() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       limitIncome : $('#addLimitIncome').val()
    },
    url: "api/familyStatus/create",
    success: function(result) {
      $("#addFamilyStatusModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getFamilyStatus();
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

function  getFamilyStatus(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/familyStatus/read",
    success: function(result) {
      var html = "";
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.familyStatus.forEach(familyStatus => {
        if(familyStatus.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailFamilyStatusForm('+familyStatus.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-3">' +
                      '<div class="icon-big text-center">' +
                        '<i class="flaticon-user-6"></i>' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-9 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-category">Status Keluarga</p>' +
                        '<h4 class="card-title">' + uppercase(familyStatus.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+familyStatus.id+'"> '+uppercase(familyStatus.name)+' </option>';
        }
      });

      $('#familyStatusList').html(html);
      $('#recoverFamilyStatusId').html(html1);
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

function deleteFamilyStatus() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/familyStatus/delete",
    success: function(result) {
      $("#detailFamilyStatusModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getFamilyStatus();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverFamilyStatus() {
  if($('#recoverFamilyStatusId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverFamilyStatusId").val(),
      },
      url: "api/familyStatus/recover",
      success: function(result) {
        $("#addFamilyStatusModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getFamilyStatus();
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
