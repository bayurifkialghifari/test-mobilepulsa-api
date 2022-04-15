<?php
	
	namespace App\Liblaries;

	class MobilePulsa
	{
		/** 
		* Username mobile pulsa
		*
		*/
		private static $username = '081909866787';

		/** 
		* API Key mobile pulsa
		*
		*/
		private static $apiKey = '655602f4b1915577';

		/** 
		* List command
		*
		*/
		private static $commands = [
			'balance' => 'bl',
			'pricelist' => 'pl',
			'checkstatus' => 'cs',
		];

		/** 
		* Production or Development
		*
		*/
		private static $isProduction = false;

		/** 
		* Call API
		*
		*/
		public function call($commands = null, $json_params = [], $type = null, $operator = null)
		{
			$signature = '';

			// Signature
			if($commands === 'balance' || $commands === 'pricelist' || $commands === 'checkstatus')
			{
				$signature = md5(self::$username.self::$apiKey.self::$commands[$commands]);
			}

			if($commands === 'check-game-id' || $commands === 'game-format-id')
			{
				$signature = md5(self::$username.self::$apiKey.$json_params['game_code']);
			}
			

			// JSON Request
			$json = '{ "commands" : "'.$commands.'", "username" : "'.self::$username.'","sign" : "'.$signature.'",';

			foreach($json_params as $f => $r)
			{
				$json .= '"'.$f.'" : "'.$r.'",';
			}
			$json = substr($json, 0, -1);
			$json .= '}';

			// URL Endpoint
			$url = "https://testprepaid.mobilepulsa.net/v1/legacy/index";

			// Check type
			if($type !== null)
			{
				$url .= '/'.$type;
			}

			// Check operator
			if($operator !== null)
			{
				$url .= '/'.$operator;
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$data = curl_exec($ch);
			curl_close($ch);

			return $data;
		}
	}