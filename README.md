hypermedia request object
================================

introduction
------------

So I found this some random file somewhere that claimed to be a REST Request Object, but I had a bunch of problems with it. The most important issue was that I wasn't able to reliably set request and response headers. Since I was building a Hypermedia (read: *real* REST) Client and Server, this was obviously no good. So with reckless abandon and zero expectations, I set out to build my own solution.

After looking into alternatives (*insert obvious PHP joke here*) for a while I stumbled upon context streams. Basically you hand build http requests and you're golden. So I wrestled with these context streams for a while, man-handled them, and folded everything up into a neat little class.

how-to use
----------

### the server

You don't *have* to use this, but I included a stripped out Sinatra server file (server.rb) for testing. If you're not familiar with Sinatra, it's a Domain-Specific Language written in Ruby that lets you spin up REST servers with nearly zero effect. Here's how to use server.rb:
  
  * Ensure you have Ruby =>1.9.3 installed
  * Run `gem install sinatra`
  * Run `ruby server.rb`
  * ctrl-c stops the server

Of course you don't have to use server.rb. You can point it at REST service you want, but playing with new toys is fun, so...

### example files

I have two usage examples for you:
* example.html
* example.php

example.html fires off an jQuery Ajax call to proxy.php, which parses the request data for the VERB, ROUTE, HEADERS, AND/OR REQUEST BODY. The proxy then uses the Hypermedia Request class to build the request, fire it off, parse the response, and relay the response back to example.html.

example.php is pure PHP so you simply use it like you would any other class.

but... why?
-----------

One word: capstone.




