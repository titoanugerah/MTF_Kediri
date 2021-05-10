$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailAreaModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addAreaModal')
  });
  getArea();
});

function detailAreaForm(id) {
  $("#detailAreaModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/area/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editFlatInsentive').val(result.detail.flatInsentive);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getArea();
  $("#keyword").val();
})

function updateArea(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       umflat : $('#editFlatInsentive').val()
    },
    url: "api/area/update",
    success: function(result) {
      $("#detailAreaModal").modal('hide');
      getArea();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewAreaForm() {
  $('#keyword').val("");
  getArea();
  $("#addAreaModal").modal('show');
}

function addArea() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       flatInsentive : $('#addFlatInsentive').val()
    },
    url: "api/area/create",
    success: function(result) {
      $("#addAreaModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getArea();
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

function  getArea(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/area/read",
    success: function(result) {
      var html = "";
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.area.forEach(area => {
        if(area.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailAreaForm('+area.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-3">' +
                      '<div class="icon-big text-center">' +
                        '<i class="flaticon-signs-3"></i>' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-9 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-category">Area</p>' +
                        '<h4 class="card-title">' + uppercase(area.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+area.id+'"> '+uppercase(area.name)+' </option>';
        }
      });

      $('#areaList').html(html);
      $('#recoverAreaId').html(html1);
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

function deleteArea() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/area/delete",
    success: function(result) {
      $("#detailAreaModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getArea();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverArea() {
  if($('#recoverAreaId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverAreaId").val(),
      },
      url: "api/area/recover",
      success: function(result) {
        $("#addAreaModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getArea();
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
