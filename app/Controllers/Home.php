<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\MobilePulsa;

	Class Home extends Controller
	{
		/**
		 * Main page
		 **/
		public function index()
		{
			view('page/home');
		}
	}