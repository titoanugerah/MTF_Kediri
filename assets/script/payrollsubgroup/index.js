var table;

$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailPayrollSubGroupModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addPayrollSubGroupModal')
  });
  $("#keyword").attr('placeholder', 'Fitur tidak tersedia');
  $("#keyword").attr('disabled', 'true');

  table = $('#payrollSubGroupTable').DataTable( {
    bProcessing: true,
    serverSide : true,
    ajax : 
    {
      url : '/payroll/api/payrollsubgroup/read',
      type : 'post'
    },
    sPaginationType: "full_numbers",
    aoColumns : [
      { "mData": "customer", "sTitle": "Customer" },
      { "mData": "status", "sTitle": "status" },
      { 
        "mData": null, 
        "sTitle": "Opsi", 
        "mRender": function (o) 
        { 
          var btnInputExcel = '<a href=/payroll/payrollsubgroup/downloadExcelInput/' + o.id + '/' + o.customerId + ' class="btn btn-success">' + 'Download Excel' + '</a> &nbsp;';
          var btnUploadExcel = '<a href=/payroll/payrollsubgroup/downloadExcelInput/' + o.id + '/' + o.customerId + ' class="btn btn-success">' + 'Upload Excel' + '</a> &nbsp;';
          var btnDownloadReportCustomer = '<a href=/payroll/payrollsubgroup/downloadReportCustomer/' + o.id + '/' + o.customerId + ' class="btn btn-success">' + 'Download Customer' + '</a> &nbsp;';
          var btnApprovalCustomer = '<a href=/payroll/payrollsubgroup/approvalCustomer/' + o.id + '/' + o.customerId + ' class="btn btn-success">' + 'Konfirmasi' + '</a> &nbsp;';
          if(o.status==1)
          {
            return btnInputExcel+btnUploadExcel;
          }
          else if(o.status==2)
          {
            return btnInputExcel+btnUploadExcel+btnDownloadReportCustomer+btnApprovalCustomer;
          }
          else if(o.status==3)
          {
            return btnApprovalCustomer;
          }
          
        }
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

function addNewPayrollSubGroup(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/payrollsubgroup/create",
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

function refresh(){
  table.ajax.reload();
}