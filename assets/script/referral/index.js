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