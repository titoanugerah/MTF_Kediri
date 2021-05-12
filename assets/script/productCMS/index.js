$(document).ready(function() {
    $('#btnDelete').hide();
    $('#summernote').summernote({
        height: 300, 
    });
    $('.select2modal').select2();
    getProduct();
});


$('#productId').on('change', function(){
  var id = $('#productId').val();
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
    url: "api/productCMS/readDetail/"+id,
    success: function(result) {
      $('#summernote').summernote('code', result.description);
      $('#name').val(result.name);
      if(result.image!=null){
        $('#image').attr('src', 'assets/picture/'+result.image);
      }else{
        $('#image').attr('src', 'http://placehold.it/1000x300');
      }
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
});

function getProduct(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/productCMS/read",
    success: function(result) {
      console.log(result);
      var html = '<option value="0"> Baru </option>';
      result.forEach(product => {
        console.log(product);
        html = html +
        '<option value="'+product.id+'"> '+uppercase(product.name)+' </option>';
      });
      $('#productId').html(html);
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
        id : $('#productId').val(),
        description : $('#summernote').summernote('code'),
        name : $('#name').val()
    },
    url: "api/productCMS/update",
    success: function(result) {
      notify('fas fa-check', 'Sukses', 'Perubahan anda berhasil disimpan', 'success');
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function createProduct(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data: {
      description : $('#summernote').summernote('code'),
      name : $('#name').val()
    },
    url: "api/productCMS/create",
    success: function(result) {
      notify('fas fa-check', 'Sukses', 'Perubahan anda berhasil disimpan', 'success');
    },error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function deleteProduct(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data: {
        id : $('#productId').val(),
    },
    url: "api/productCMS/delete",
    success: function(result) {
      notify('fas fa-check', 'Sukses', 'Produk  berhasil dihapus', 'success');
      getProduct();

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
    url: 'api/productCMS/upload/'+$('#productId').val(),
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