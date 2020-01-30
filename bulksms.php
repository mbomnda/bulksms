<?php
/*
	Authur: freebulksmsonline.com GitHub User: Mbomnda
	Save file as bulksms.php and enjoy
	Simple and easy for modification, PHP script for SMS sending through HTTP with you own Sender ID and delivery reports. 
	You just have to type your account information on www.freebulksmsonline.com and upload file on server.

	https://www.facebook.com/freebulksmsonline/

	Instruction:
	Find 1 parameters in my-account and type your account information on your my-account page freebulksmsonline.com/my-account
	
		1. $token = "***************"; // Change ********, and put your FREE SMS Bulk SMS  API authentication token
*/
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="PHP script for Bulk SMS sending. Send Bulk SMS with API connection.">
			<title>PHP Bulk SMS script</title>

			<style type="text/css">
				body{
					font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif; 
					font-size:12px;
				}
				p, h1, form, button{border:0; margin:0; padding:0;}
				.spacer{clear:both; height:1px;}
				/* ----------- My Form ----------- */
				.myform{
					margin:0 auto;
					width:400px;
					padding:14px;
				}
				/* ----------- stylized ----------- */
					#stylized{
						border:solid 2px #b7ddf2;
						background:#ebf4fb;
					}
					#stylized h1 {
						font-size:14px;
						font-weight:bold;
						margin-bottom:8px;
					}
					#stylized p{
						font-size:11px;
						color:#666666;
						margin-bottom:20px;
						border-bottom:solid 1px #b7ddf2;
						padding-bottom:10px;
					
				}
			</style> 
			<script type="text/javascript">
	
				//Edit the counter/limiter value as your wish
				var count = "160";   //Example: var count = "175";
				function limiter(){
				var tex = document.myform.text.value;
				var len = tex.length;
				if(len > count){
						tex = tex.substring(0,count);
						document.myform.text.value =tex;
						return false;
				}
				document.myform.limit.value = count-len;
				}


			</script> 

		</head>

		<body>
		<?php
		
		$token = "*************************************"; // Change ********, and put your FREE SMS Bulk SMS  API authentication token
		$text = $_REQUEST["text"];
		$to = $_REQUEST["to"];
		$option = $_REQUEST["option"];

			switch ($option) {

			case sendsms:
				
				if ($text == "") { echo "<center>Error!<br>Text not entered<br><a href=\"javascript:history.back(-1)\">Go Back</a></center>"; die; } else { }
				if ($to == "") { echo "<center>Error!<br>Number not entered<br><a href=\"javascript:history.back(-1)\">Go Back</a></center>"; die; } else { }
				
			// You can change explode to (, \n ; . -) or something else. 
			
				$to_arr = explode(",", $to);

				foreach ($to_arr as $to_x){	
				
				$url = "https://freebulksmsonline.com/api/v1/index.php";

				$postfields = array(
					'token' => "$token",
					'number' => "$to_x",
					'message' => "$text"
				);

				if (!$curld = curl_init()) {
					exit;
				}

				curl_setopt($curld, CURLOPT_POST, true);
				curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
				curl_setopt($curld, CURLOPT_URL,$url);
				curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

				$curl_output = curl_exec($curld);
				
				$response = json_decode($curl_output);

				
				}
				
				
				if ($response->success == "false") {
					echo "<center>Error message:<b> $msgstatus </b><br><a href=\"index.php\" ><b>Go Back</b></a></center>";

				} else {
				echo "<center>Date: $response->created_at <br>";
					echo "To: $to <br>";
					echo "Message ID: $response->id <br>";
					echo "Message Success: $response->success <br>";
					echo "Message Status: $response->status <br>";
					echo "<br><a href=\"bulksms.php\"><b>Send New SMS Message</b></a></center>";

				}
				
				//Header("Location: $PHP_SELF");
			break;

			default:

			echo "<div id=\"stylized\" class=\"myform\">"
			   ."<b>Free SMS Bulk SMS demo</b>"
			   ."<form name=\"myform\" method=post action=\"$PHP_SELF?option=sendsms\">"
			   ."<table width=100% border=\"0\">"
			   ."<tr>"
				 ."<td>Numbers<br>(separate with ,)</td>"
				 ."<td><textarea style=\"resize: none;width:80%;border: 1px solid #523f6d;outline:none;\" placeholder=\"examples 00xxxxxxx,011xxxxxxx,+xxxxxxx,\"  rows=\"4\" cols=\"25\" name=\"to\"></textarea></td>"
			   ."</tr>"
			   ."<tr style=\"padding:10px;\">"
				 ."<td>Message: </td>"
				 ."<td><textarea style=\"resize: none;width:80%;padding;5px;border: 1px solid #523f6d;outline:none;\" wrap=physical rows=\"4\" cols=\"25\" name=\"text\" onkeyup=limiter()></textarea></td>"
			   ."</tr>"
				   ."<tr>"
			   ."<td></td>"
			  ."<td>Character left: <script type=\"text/javascript\">"
			   ."document.write(\"<input type=text name=limit size=4 readonly value=\"+count+\">\");"
			   ."</script><br></td>"
			   ."</tr>"
			   ."<tr>"
				 ."<td> </td>"
				 ."<td><input style=\"width:8em;font-size:10px;\" type=submit name=submit value=Send>"
				 ."<div class=\"spacer\"></div></td>"
			   ."</tr>"
			   ."</table>"
			   ."</form>"
				   ."<a href=https://www.freebulksmsonline.com/free-sms-api>SMS BULK SMS Api</a>"
			."</div>";


			}

		?>

	</body>
</html>