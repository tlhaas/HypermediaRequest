<?php

  require_once("./Hypermedia_Request.php");
  $API_HOST = "http://localhost:4567";
  $headers = ["Accept: application/HAL+json", "Authorization: $token"];
  $request = new Hypermedia_Request("GET", "$API_HOST/customer", $headers);
  $request->execute(); 

  // Grab the response headers...
  $resp_headers   = $request->getResponseHeaders();
  $http_status    = $resp_headers['Status'];

  //... and parse for a 200
  if (preg_match("/200/i", $http_status)){
    $resp_body      = json_decode($request->getResponseBody(), true);
    print "<h1>Response headers:</h1>";
    dump($resp_headers);
    print "<h1>Response body:</h1>";
    dump($resp_body);
  } 
  else { 
    dump($http_status);
  }
  
  function dump( $struct ){
    print "<pre>";
    print_r($struct);
    print "</pre>";  
  }

?>