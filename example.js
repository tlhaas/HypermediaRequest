var token   = "omgwhateverthisisatokenbro";
var headers = ["Authorization: " + token + ""];
headers     = JSON.stringify(headers);
var data = {method:'get', resource:'/customer', headers:headers};
createCustomerAjax(data);

function createCustomerAjax(theData){
  $.ajax({
    type:'post',
    async:'true',
    cache:false,
    data:theData,
    url:'./proxy.php',
    dataType:'json',
    statusCode: {
      501:function() { 
        alert("<p>501: Not Implemented</p>");
      },
      404:function() { 
        alert("404: Bad Login/Not Found/Whatever");
      },
      200:function( resp ) { 
         alert("w00t! Found it!");
      }
    }
  });
}

