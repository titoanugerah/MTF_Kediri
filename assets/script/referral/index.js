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

  function uploadAttachment(){
    var fd = new FormData();
    var files = $('#fileUpload')[0].files[0];
    fd.append('file',files);
    $.ajax({
      url: 'api/referral/picture/'+($('#date').val()), //.replace('-','/'),
      type: 'post',
      data: fd,
      dataType : "JSON",
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

  function upload() {
    var fd = new FormData();
    var files = $('#fileUpload1')[0].files[0];
    fd.append('file',files);
    $.ajax({
      url: 'api/referral/upload/'+($('#date').val()), //.replace('-','/'),
      type: 'post',
      data: fd,
      dataType : "JSON",
      contentType: false,
      processData: false,
      success: function(response){
        $('#uploadExcelForm').modal('hide');
        uploadAttachment();
        notify('fas fa-check', 'Sukses', response.message , response.status);
      },
      error: function(result){
        console.log('error', result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');  
      }
    });
  }

  function getReferral(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      url: "api/referral/readReferral",
      success: function(result) {
        var html ='<option value="0"> Pilih Tanggal </option>';
        result.forEach(referral => {
          html = html + '<option value="'+referral.id+'"> '+(referral.month)+' </option>';
        });
        $('#referralId').html(html);
      },error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
      
  }

  $('#referralId').on('change', function(){
    getDetail();
  });

  function numberwithcommas(x) {
    var parts = x.toString().split(".");
    parts[0]=parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
    return parts.join(",");
  }

  function getDetail(){
    var id = $('#referralId').val();
    $.ajax({
      type: "POST",
      dataType : "JSON",
      url: "api/referral/readDetail/"+id,
      success: function(result) {
        var no = 1;
        var html = null;
        for(i=1; i < result.length; i++){          
          var btns1 ='<button class="btn btn-danger" onclick="">Hapus</button>';
          html = html +
            '<tr>' +
            '<td>'+i+'</td>' +
            '<td>'+result[i].name+'</td>' +
            '<td>'+result[i].prospectUnit+' ( Rp. '+numberwithcommas(result[i].prospectAmount)+')'+'</td>' +
            '<td>'+result[i].goLiveUnit+' ( Rp. '+numberwithcommas(result[i].goLiveAmount)+')'+'</td>' +
            '<td> '+btns1+'</td>' +
            '</tr>';
          }
          $('#referralData').html(html);
  
      },error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
