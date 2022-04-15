<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\MobilePulsa;

	Class TopUp extends Controller
	{
		/**
		 * Price list show
		 **/
		public function index($type, $operator)
		{
			// Check balance
			// $balance = MobilePulsa::call('balance');
			
			// Check price list
			$pricelist = MobilePulsa::call('pricelist', ['status' => 'active'], $type, $operator);
			$pricelist = json_decode($pricelist);
			$game_id = '';

			if($operator == 'mobile_legend' || $operator == 'arena_of_valor' || $operator == 'free_fire')
			{
				$game_id = game_id($operator);
			}

			view('page/topup', [
				'pricelist' => $pricelist->data,
				'game_id' => $game_id,
			]);
		}

		/**
		 * Check user
		 **/
		public function checkuser()
		{
			$game_id = self::post('game-id');
			$user_id = self::post('user-id');
			$zone_id = self::post('zone-id');

			// Format Check
			$formatId = MobilePulsa::call('game-format-id', [
				'game_code' => $game_id,
			]);

			// ID
			$id = '';

			if($game_id == '139' || $game_id == '135')
			{
				$id = $user_id;
			}
			else
			{
				$id = $user_id.'|'.$zone_id;
			}


			// Check Game ID
			$gameId = MobilePulsa::call('check-game-id', [
				'game_code' => $game_id,
				'hp' => $id,
			]);

			print_r($gameId);
		}

		/**
		 * TopUp request
		 **/
		public function topup()
		{
			$red_id = time();
			$id = self::post('id');
			$prod_code = self::post('prod_code');
		}
	}