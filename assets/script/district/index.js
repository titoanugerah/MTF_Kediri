$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailDistrictModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addDistrictModal')
  });
  getDistrict();
  getArea();
});

function detailDistrictForm(id) {
  $("#detailDistrictModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/district/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editUMK').val(result.detail.umk);
      $('#editAreaId').val(result.detail.areaId);
      getArea();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getDistrict();
  $("#keyword").val();
})

function updateDistrict(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       areaId : $("#editAreaId").val(),
       umk : $('#editUMK').val()
    },
    url: "api/district/update",
    success: function(result) {
      $("#detailDistrictModal").modal('hide');
      getDistrict();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewDistrictForm() {
  $('#keyword').val("");
  getDistrict();
  $("#addDistrictModal").modal('show');
}

function addDistrict() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       umk : $('#addUMK').val(),
       areaId : $('#addAreaId').val()       
    },
    url: "api/district/create",
    success: function(result) {
      $("#addDistrictModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getDistrict();
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

function  getDistrict(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/district/read",
    success: function(result) {
      var html = "";
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.district.forEach(district => {
        if(district.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailDistrictForm('+district.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-12 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-category">Area ' + uppercase(district.area)+'</p>' +
                        '<h4 class="card-title">' + uppercase(district.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+district.id+'"> '+uppercase(district.name)+' </option>';
        }
      });

      $('#districtList').html(html);
      $('#recoverDistrictId').html(html1);
    },
    error: function(result) {
      console.log("Error", result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
 });

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
      var html0 = '<option value="0"> Silahkan pilih </option>';
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.area.forEach(area => {
        if($('#editAreaId').val()==area.id){
          html0 = html0 +
          '<option value="'+area.id+'" selected> '+uppercase(area.name)+' </option>';
        } else {
          html0 = html0 +
          '<option value="'+area.id+'"> '+uppercase(area.name)+' </option>';   
        }

          html1 = html1 +
          '<option value="'+area.id+'"> '+uppercase(area.name)+' </option>';
      });
      console.log('area', result);
      $('#editAreaId').html(html0);
      $('#addAreaId').html(html1);
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

function deleteDistrict() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/district/delete",
    success: function(result) {
      $("#detailDistrictModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getDistrict();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverDistrict() {
  if($('#recoverDistrictId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverDistrictId").val(),
      },
      url: "api/district/recover",
      success: function(result) {
        $("#addDistrictModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getDistrict();
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
