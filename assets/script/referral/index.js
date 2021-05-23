$(document).ready(function() {
    $('#referralTable').DataTable();
    getReferral();
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

  function upload() {
    var fd = new FormData();
    var files = $('#fileUpload1')[0].files[0];
    fd.append('file',files);
    $.ajax({
      url: 'api/referral/upload/'+($('#date').val()), //.replace('-','/'),
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        console.log(response);
        notify('fas fa-check', 'Sukses', response.message , response.status);
      },
      error: function(result){
        console.log('error', result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');  
      }
    });
  }