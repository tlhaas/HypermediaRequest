hypermedia (rest) request object
================================

introduction
------------

So I found this some random file somewhere that claimed to be a REST Request Object, but I had a bunch of problems with it. The most important issue was that I wasn't able to reliably set request and response headers. Since I was building a Hypermedia (read: *real* REST) Client and Server, this was obviously no good. So with reckless abandon and zero expectations, I set out to build my own solution.

After looking into alternatives (*insert obvious PHP joke here*) for a while I stumbled upon context streams. Basically you hand build http requests and you're golden. So I wrestled with these context streams for a while, man-handled them, and folded everything up into a neat little class.

how-to use
----------

I have two usage examples for you:
* example.js
* example.php

example.js fires off an jQuery Ajax call to proxy.php. proxy.php parses the request data for the VERB, ROUTE, HEADERS, AND/OR REQUEST BODY. It then uses the Hypermedia Request class to build the request, fire the request, parse the response, then relay the response back to example.js.

example.php is pure PHP so you simply use it like you would any other class.

but... why?
-----------

One word: capstone.




