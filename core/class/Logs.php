<?php
class Logs
{
	public function GetLastLogs($nbr = 20)
	{
		return $GLOBALS['DB']->GetContent("logs", [], 'ORDER BY id DESC LIMIT '.$nbr);
	}

	public function AddLogs($content)
	{
		$GLOBALS['DB']->Insert("logs", ["content" => $content], false);

		$log = strip_tags($content);
		$log = str_replace("&nbsp;", " ", $log);

		function delete_all_between($beginning, $end, $string) {
  		$beginningPos = strpos($string, $beginning);
  		$endPos = strpos($string, $end);
  		if ($beginningPos === false || $endPos === false) {
  			return $string;
  		}

  		$textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  		return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string)); // recursion to ensure all occurrences are replaced
  	}

		$log = delete_all_between('[', ']', $log);

		$webhookurl = "https://discord.com/api/webhooks/715947693851279411/aZ_Zw-1k94Ev4wAHHfc-TKVtUR0p8ItskUgnYQqzTHkk3axUxYOLwdWap__RiHfa1-PV";

		$timestamp = date("c", strtotime("now"));

		$json_data = json_encode([
		    "username" => "Kalysia | Logs",
		    "avatar_url" => "https://kpanel.cz/home/assets/img/logo/kpanel.png",
		    "tts" => false,
		    "embeds" => [
		        [
		            // Embed Title
		            "title" => "Kalysia | Logs",

		            // Embed Type
		            "type" => "rich",

		            // URL of title link
		            "url" => "https://kpanel.cz/login.php",

		            // Timestamp of embed must be formatted as ISO8601
		            "timestamp" => $timestamp,

		            // Embed left border color in HEX
		            "color" => hexdec( "9834eb" ),

		            // Footer
		            "footer" => [
		                "text" => "Logged",
		                "icon_url" => "https://kpanel.cz/home/assets/img/logo/kpanel.png"
		            ],

		            // Additional Fields array
		            "fields" => [
		                // Field 1
		                [
		                    "name" => "> Logged:",
		                    "value" => "$log",
		                    "inline" => false
		                ]
		                // Field 2
		                //[
		                    //"name" => "Field #2 Name",
		                    //"value" => "Field #2 Value",
		                    //"inline" => true
		                //]
		                // Etc..
		            ]
		        ]
		    ]

		], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

		$ch = curl_init( $webhookurl );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
		// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
		echo $response;
		curl_close( $ch );

	}
	public function DelLogs()
	{
		$GLOBALS['DB']->Delete("logs");

		$webhookurl = "https://discordapp.com/api/webhooks/715947693851279411/aZ_Zw-1k94Ev4wAHHfc-TKVtUR0p8ItskUgnYQqzTHkk3axUxYOLwdWap__RiHfa1-PV";

		$timestamp = date("c", strtotime("now"));

		$clearer = Account::GetUsername();

		$json_data = json_encode([
				"username" => "Kalysia | Logs",
				"avatar_url" => "https://kpanel.cz/home/assets/img/logo/kpanel.png",
				"tts" => false,
				"embeds" => [
						[
								// Embed Title
								"title" => "Kalysia | Logs",

								// Embed Type
								"type" => "rich",

								// URL of title link
								"url" => "https://kpanel.cz/login.php",

								// Timestamp of embed must be formatted as ISO8601
								"timestamp" => $timestamp,

								// Embed left border color in HEX
								"color" => hexdec( "9834eb" ),

								// Footer
								"footer" => [
										"text" => "Logged",
										"icon_url" => "https://kpanel.cz/home/assets/img/logo/kpanel.png"
								],

								// Additional Fields array
								"fields" => [
										// Field 1
										[
												"name" => "> Cleared:",
												"value" => "Les logs du panel ont été clear par $clearer.",
												"inline" => false
										]
										// Field 2
										//[
												//"name" => "Field #2 Name",
												//"value" => "Field #2 Value",
												//"inline" => true
										//]
										// Etc..
								]
						]
				]

		], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

		$ch = curl_init( $webhookurl );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
		// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
		echo $response;
		curl_close( $ch );
	}
}
?>
