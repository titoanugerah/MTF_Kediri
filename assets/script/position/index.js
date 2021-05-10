$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailPositionModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addPositionModal')
  });
  getPosition();
});

function detailPositionForm(id) {
  $("#detailPositionModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/position/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editInsentive').val(result.detail.insentive);
      $('#editPremium').val(result.detail.premium);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getPosition();
  $("#keyword").val();
})

function updatePosition(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       insentive : $("#editInsentive").val(),
       premium : $('#editPremium').val()
    },
    url: "api/position/update",
    success: function(result) {
      $("#detailPositionModal").modal('hide');
      getPosition();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewPositionForm() {
  $('#keyword').val("");
  getPosition();
  $("#addPositionModal").modal('show');
}

function addPosition() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       insentive : $("#addInsentive").val(),
       premium : $('#addPremium').val()
    },
    url: "api/position/create",
    success: function(result) {
      $("#addPositionModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getPosition();
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

function  getPosition(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/position/read",
    success: function(result) {
      var html = "";
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.position.forEach(position => {
        if(position.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailPositionForm('+position.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-12 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-category">Posisi Pekerjaan </p>' +
                        '<h4 class="card-title">' + uppercase(position.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+position.id+'"> '+uppercase(position.name)+' </option>';
        }
      });

      $('#positionList').html(html);
      $('#recoverPositionId').html(html1);
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

function deletePosition() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/position/delete",
    success: function(result) {
      $("#detailPositionModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getPosition();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverPosition() {
  if($('#recoverPositionId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverPositionId").val(),
      },
      url: "api/position/recover",
      success: function(result) {
        $("#addPositionModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getPosition();
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
