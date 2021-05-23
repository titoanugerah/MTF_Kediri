$(document).ready(function() {
    $('#btnDelete').hide();
    $('#summernote').summernote({
        height: 300, 
    });
    $('.select2modal').select2();
    getOtherPage();
    $('#attachment').DataTable();
});

$('#otherPageId').on('change', function(){
  getDetail();
});

function getDetail(){
  var id = $('#otherPageId').val();
  if(id==0)
  {
    $('#btnDelete').hide();
    $('#btnAdd').show();
  }else{
    $('#btnDelete').show();
    $('#btnAdd').hide();

  }
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/otherPageCMS/readDetail/"+id,
    success: function(result) {
      var no = 1;
      var html = null;
      $('#summernote').summernote('code', result.page.description);
      $('#name').val(result.page.name);
      $('#pageCategoryId').val(result.page.pageCategoryId).change();
      if(result.page.image!=null){
        $('#image').attr('src', 'assets/picture/'+result.page.image);
      }else{
        $('#image').attr('src', 'http://placehold.it/1000x300');
      }
      console.log(result.attachment);
      result.attachment.forEach(attachment => {
        var btns1 ='<button class="btn btn-danger" onclick="deleteAttachment('+attachment.id+')">Hapus</button>';
        var btns2 ='<button class="btn btn-success" onclick="download('+attachment.id+')">Download</button>';
        html =
        '<tr>' +
        '<td>'+no+'</td>' +
        '<td>'+attachment.name+'</td>' +
        '<td>'+attachment.remark+'</td>' +
        '<td> '+btns1 + '&nbsp;'+ btns2+'</td>' +
        '</tr>' + html;    
        no++;
      });

      $('#attachmentList').html(html);

    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function deleteAttachment(id){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data: {
        id : id,
    },
    url: "api/otherPageCMS/deleteAttachment",
    success: function(result) {
      notify('fas fa-check', 'Sukses', 'Produk  berhasil dihapus', 'success');
      getDetail();
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function getOtherPage(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/otherPageCMS/read",
    success: function(result) {
      console.log(result);
      var html = '<option value="0"> Baru </option>';
      var html1 = '<option value=0> Pilih Kategori </option> ';
      result.otherPage.forEach(otherPage => {
        console.log(otherPage);
        html = html +
        '<option value="'+otherPage.id+'"> '+uppercase(otherPage.name)+' </option>';
      });

      result.category.forEach(category => {
        console.log(category);
        html1 = html1 +
        '<option value="'+category.id+'"> '+uppercase(category.name)+' </option>';
      });

      $('#otherPageId').html(html);
      $('#pageCategoryId').html(html1);
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
    
}

function uppercase(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function updateContent(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data: {
        id : $('#otherPageId').val(),
        description : $('#summernote').summernote('code'),
        name : $('#name').val(),
        pageCategoryId : $('#pageCategoryId').val()
    },
    url: "api/otherPageCMS/update",
    success: function(result) {
      notify('fas fa-check', 'Sukses', 'Perubahan anda berhasil disimpan', 'success');
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function createOtherPage(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data: {
      name : $('#name').val(),
      description : $('#summernote').summernote('code'),      
      pageCategoryId : $('#pageCategoryId').val()      
    },
    url: "api/otherPageCMS/create",
    success: function(result) {
      notify('fas fa-check', 'Sukses', 'Perubahan anda berhasil disimpan', 'success');
      getOtherPage();
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function deleteOtherPage(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data: {
        id : $('#otherPageId').val(),
    },
    url: "api/otherPageCMS/delete",
    success: function(result) {
      notify('fas fa-check', 'Sukses', 'Produk  berhasil dihapus', 'success');
      getOtherPage();

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
    url: 'api/otherPageCMS/upload/'+$('#otherPageId').val(),
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

function uploadFileAttachment() {
  var fd = new FormData();
  var files = $('#fileUpload1')[0].files[0];
  fd.append('file',files);
  $.ajax({
    url: 'api/otherPageCMS/uploadAttachment/'+$('#otherPageId').val(),
    type: 'post',
    dataType : "JSON",
    data: fd,
    contentType: false,
    processData: false,
    success: function(response){
      notify('fas fa-check', 'Sukses', 'Gambar berhasil disimpan', 'success');

      $.ajax({
        type: "POST",
        dataType : "JSON",
        data: {
            id : response.id,
            name : $('#nameAttachment').val(),
            remark : $('#remark').val()            
        },
        url: "api/otherPageCMS/updateAttachment",
        success: function(result) {
          notify('fas fa-check', 'Sukses', 'Produk  berhasil dihapus', 'success');
          getDetail();    
        },error: function(result) {
          console.log(result);
          notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
        }
      });
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