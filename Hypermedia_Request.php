<?php


	class Hypermedia_Request {
		
		private $PROTOCOL = "http";
		private $PROTOCOL_VER = "1.1";

		private $uri = "";
		private $verb	= "";
		private $request_headers = ["Connection: Close","Host: localhost:4567"];
		private $request_body = NULL;

		private $options = [];
		private $context = "";
		private $ignore_errors = true;

		private $response = "";
		private $response_headers = [];

		public function __construct($verb, $uri, $headers=array(), $request_body=NULL){
			$this->verb = $verb;	// Set the verb 
			$this->uri 	= $uri;		// Set the URI

			if (!empty($headers)) {
				foreach ($headers as $header) { array_push($this->request_headers, $header); }	// Set the headers, if they exist
			}
			if (!is_null($request_body)) { $this->request_body = $request_body; }	// Set the request body, if it exists
		}

		public function execute(){
			// Build out the options hash
			$this->options[$this->PROTOCOL]['protocol_version'] = $this->PROTOCOL_VER;	// Set the HTTP version
			$this->options[$this->PROTOCOL]['method'] 	= $this->verb;					// Set the verb
			$this->options[$this->PROTOCOL]['header'] 	= $this->request_headers;		// Add the headers
			$this->options[$this->PROTOCOL]['content']	= $this->request_body;			// Add the content
			$this->options[$this->PROTOCOL]['ignore_errors'] = $this->ignore_errors;	// Read the response body on errors (per rfc-2616)

			$this->context = stream_context_create($this->options);						// Build the HTTP context stream (whatever the hell that is)

			// FIRE!! 
			$this->response = file_get_contents($this->uri, false, $this->context);

			// Read the response headers and add them into the object
			// The $http_response_header array is similar to the get_headers() function. 
			foreach ($http_response_header as $header){
				// The status code is special: it doesn't have a colon
				if (preg_match("/http/i", $header)) {
					$this->response_headers['Status'] = $header;
				} 
				// Everything else
				else {
					$pieces = explode(":", $header, 2);
					$this->response_headers[$pieces[0]] = $pieces[1];
				}
			}
		}

		public function getResponseBody(){
			return $this->response;
		}

		public function getResponseHeaders(){
			return $this->response_headers;
		}

		public function getOptions(){
			return $this->options;
		}

}

?>