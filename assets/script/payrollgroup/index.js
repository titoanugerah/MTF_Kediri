var table;

$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailPayrollGroupModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addPayrollGroupModal')
  });
  $("#keyword").attr('placeholder', 'Fitur tidak tersedia');
  $("#keyword").attr('disabled', 'true');

  table = $('#payrollGroupTable').DataTable( {
    bProcessing: true,
    serverSide : true,
    ajax : 
    {
      url : '/payroll/api/payrollgroup/readDetail/'+$('#id').val(),
      type : 'post'
    },
    sPaginationType: "full_numbers",
    aoColumns : [
      { "mData": "customer", "sTitle": "Customer" },
      { "mData": "status", "sTitle": "Status" },
      { 
        "mData": null, 
        "sTitle": "Opsi", 
        "mRender": 
        function (o) 
        { 
          var btnInputExcel = '<a href=/payroll/payrollgroup/downloadExcelInput/' + o.id + ' class="btn btn-success">' + 'Download Excel' + '</a> &nbsp;';
          var btnDownloadReportCustomer = '<a href=/payroll/payrollgroup/downloadCustomerReport/' + o.id + ' class="btn btn-success">' + 'Download Customer' + '</a> &nbsp;';
          var btnApprovalCustomer = '<a href=/payroll/payrollsubgroup/approvalCustomer/' + o.id + ' class="btn btn-success">' + 'Konfirmasi' + '</a> &nbsp;';
          if(o.status==1)
          {
            return btnInputExcel;
          }
          else if(o.status==2)
          {
            return btnInputExcel+btnDownloadReportCustomer+btnApprovalCustomer;
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

function uppercase(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function unauthorized() {
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
