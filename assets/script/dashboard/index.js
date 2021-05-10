$(document).ready(function(){
    $('.select2modal').select2({
        dropdownParent: $('#detailIssueModal')
    });
    $('.select2addmodal').select2({
        dropdownParent: $('#addIssueModal')
    });
    $("#keyword").attr('placeholder', 'Fitur tidak tersedia');
    $("#keyword").attr('disabled', 'true');
  
  });
  
  setTimeout(function(){
    $('.datatable').DataTable({
      "order": [[ 0, "desc" ]],
//      dom: 'Bfrtip',
    //   buttons: [
    //  'csv', 'excel', 'pdf']  
  });
  }, 600);
  
  

  function unauthorized() {
    notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
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
  
  