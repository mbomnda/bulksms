# bulksms
Send sms to over a 200 countries worldwide using the freebulksmsonline.com API
It works with different programming languages.
Supportd Chinese Characters

Up to 5 free SMS Daily

Example code is provided bulksms.php

Send Message via API

API Endpoint
URL:	https://freebulksmsonline.com/api/v1/index.php

Method:	POST/GET

Request Parameters
Parameter	Required	Description

number	YES	Containing the numbers the message is to be sent to (use , to separate numbers)
message	YES	The content of the message to be sent
token	  No	Limited to 5 messages per day without token. Token from my-account page after login

Success Response
success:	true
Content Type:	application/json
Output format:	
{"success":"true","error":"","status":"sent","id":"4475e2b374243795166010553","number":"+6282139900300","message":"I am message","created_at":"2020-01-24 06:28:18pm","user_limit":"4"}
                      
Failed Response
success:	false
Content Type:	application/json
Output format:	
{"success":"false","error":"Invalid phone number","status":"","id":"","number":"","message":"","created_at":"","user_limit":"5"}

Last update 2020-24-01
