$(document).ready(function() {
    $('#summernote').summernote({
        height: 300, 
    });

    getContent();
});

function getContent(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/termsCMS/read",
    success: function(result) {
      $('#summernote').summernote('code', result.description);
      if(result.image!=null){
        $('#image').attr('src', 'assets/picture/'+result.image);
      }   
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
    
}

function updateContent(){
    $.ajax({
        type: "POST",
        dataType : "JSON",
        data: {
            id : 2,
            description : $('#summernote').summernote('code')
        },
        url: "api/termsCMS/update",
        success: function(result) {
            notify('fas fa-check', 'Sukses', 'Perubahan anda berhasil disimpan', 'success');
            getContent();
        },error: function(result) {
          console.log(result);
          notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
        }
      });
}

function upload() {
  var fd = new FormData();
  var files = $('#fileUpload')[0].files[0];
  fd.append('file',files);
  $.ajax({
    url: 'api/termsCMS/upload',
    type: 'post',
    data: fd,
    contentType: false,
    processData: false,
    success: function(response){
      notify('fas fa-check', 'Sukses', 'Gambar berhasil disimpan', 'success');
    },
    error: function(result){
      console.log('error', result);
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