<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index() 
	{
		$data['title'] = 'BorrowMe';
		$this->load->view('auth/landing-page', $data);
	}

}