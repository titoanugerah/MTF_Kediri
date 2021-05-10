var table;

$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailPayrollPeriodModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addPayrollPeriodModal')
  });
  $("#keyword").attr('placeholder', 'Fitur tidak tersedia');
  $("#keyword").attr('disabled', 'true');

  table = $('#payrollPeriodTable').DataTable( {
    bProcessing: true,
    serverSide : true,
    ajax : 
    {
      url : 'api/payrollperiod/read',
      type : 'post'
    },
    sPaginationType: "full_numbers",
    aoColumns : [
      { "mData": "year", "sTitle": "Tahun" },
      { "mData": "month", "sTitle": "Bulan" },
      { "mData": "status", "sTitle": "Status" },
      { 
        "mData": null, 
        "sTitle": "Opsi", 
        "mRender": function (o) { return '<a href=payrollgroup/' + o.id + ' class="btn btn-primary">' + 'Detail' + '</a>';}
      }
    ],

    sortable : true    
  });

});

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

function addNewPayrollPeriod(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/payrollperiod/create",
    success: function(result) {
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      table.ajax.reload();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', result.responseText, 'danger');
    }
  });
}

function uppercase(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function unauthorized() {
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
