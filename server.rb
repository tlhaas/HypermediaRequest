require 'sinatra'
require 'json'

before do
	content_type "application/HAL+json"
end

get '/customer' do
	resp = {
    "id"    => "1",
    "fname" => "Josh",
    "mname" => "Rawdog",
    "lname" => "Richmond"
  }
  resp.to_json
end