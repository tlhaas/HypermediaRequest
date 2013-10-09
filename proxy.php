<?php

  if ($_POST['method']){

    $VERB     = strtoupper($_POST['method']);
    $RESOURCE = $_POST['resource'];
    $ROOT     = "http://localhost:4567";
    $REQ_BODY = $_POST['data'];
    $HEADERS  = json_decode($_POST['headers']);

    require_once("./Hypermedia_Request.php");

    if ($VERB == "POST"){
      $request = new Hypermedia_Request($VERB, "$ROOT$RESOURCE", $HEADERS, $REQ_BODY);
      $request->execute(); 
    }
    else if ($VERB == "GET"){
      $request = new Hypermedia_Request($VERB, "$ROOT$RESOURCE", $HEADERS);
      $request->execute(); 
    } 
    else if ($VERB == "PUT"){
      $request = new Hypermedia_Request($VERB, "$ROOT$RESOURCE", $HEADERS, $REQ_BODY);
      $request->execute(); 
    }
    else if ($VERB == "PATCH"){
      $request = new Hypermedia_Request($VERB, "$ROOT$RESOURCE", $HEADERS, $REQ_BODY);
      $request->execute(); 	
    }
    else if ($VERB == "DELETE"){
      $request = new Hypermedia_Request($VERB, "$ROOT$RESOURCE", $HEADERS);
      $request->execute(); 
    }
    else {
      // unsupported verb
      header("HTTP/1.1 405 Method Not Supported");
      exit;
    }

    $resp_headers = $request->getResponseHeaders();
    $resp_body    = $request->getResponseBody();

    // Relay the HTTP response...
    foreach ($resp_headers as $key=>$value){
      if ($key == "Status"){
        header("$value");
      } else {
        header("$key: $value");
      }
    }

    // ... then the response body ...
    if (!is_null($resp_body)){
      echo($resp_body);
    }

    // then ... KILL IT WITH FIRE!!!!
    $request = NULL;	

  } # end main if

?>