<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }

	public function index()
	{
		echo "Access system is forbidden.";
	}
	
}
