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

	public function login() 
	{
		if($this->session->userdata('email')) {
			redirect('user');
		}

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ( $this->form_validation->run() == false) {
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			//Validasi nya sukses
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		//jika usernya ada
		if ( $user ) {
			//jika usernya aktif
			if($user['is_active'] == 1) {

				//cek password
				if(password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					
					$this->session->set_userdata($data);

					if($user['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user/databarang');
					}

				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
					redirect('auth/login');
				}

			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This Email has not been activated! </div>');
				redirect('auth/login');
			}

		} 
		else 
		{
			//tdak ada user yang terdaftar
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered</div>');
			redirect('auth/login');
		}

	}

}