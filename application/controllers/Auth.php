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

<<<<<<< HEAD
<<<<<<< HEAD
		public function registration()
=======
	public function registration()
>>>>>>> origin/user1
=======


		public function registration()
>>>>>>> 89fc6ae3e125c9f85d2f7b4297032c66693c0799
	{
		if($this->session->userdata('email')) {
			redirect('user');
		}

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password Dont Match!',
			'min_length' => 'Password Too Short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if( $this->form_validation->run() == false) {
			$data['title'] = 'Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			//kirim email
			$this->_sendEmail($token, 'verify');

			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratuliation! Your account has been created. Please check your email to activate your account!</div>');
			redirect('auth/login');

		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'aplikasipinjamhelp@gmail.com',
			'smtp_pass' => 'jessicaer15',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->from('aplikasipinjamhelp@gmail.com', 'Pinjam Admin');
		$this->email->to($this->input->post('email'));

		if($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '& token=' . urlencode($token) . '">Active</a>');
		} else if($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your Password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '& token=' . urlencode($token) . '">Reset Password</a>'); 
		}
		

		if($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die; 
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		//mengecek email yg diurl benar atau tidak
		if($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			//mengecek token ada didatabase 
			if($user_token) {

				//untuk mengecek waktu batasan pengaktifan token
				if(time() - $user_token['date_created'] < (60*60*24)) {

					//update data ke database
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					//delete token
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">'. $email .' has been activated. Please login.</div>');
						redirect('auth/login');

				} else {

					//menghapus user dari database karna token udah habis 
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token expired.</div>');
						redirect('auth/login');

				}


			} else {
				
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token Invalid</div>');
					redirect('auth/login');
			}
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong Email.</div>');
				redirect('auth/login');		
		}
	}

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 89fc6ae3e125c9f85d2f7b4297032c66693c0799
		public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

		if($this->form_validation->run() == false) {
			
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');

		} else {
			
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

			if($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => date()
 				];

 				$this->db->insert('user_token', $user_token);
 				$this->_sendEmail($token, 'forgot');

 				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset password!</div>');
 				redirect('auth/forgotpassword');
				
			} else {
				
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
				redirect('auth/forgotpassword');

			}
		}	
	}

	public function resetPassword() 
	{
		$email  = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if($user) {

			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if($user_token) {

				$this->session->set_userdata('reset_email',  $email);
				$this->changePassword();

			} else {

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password is failed. Wrong token!</div>');
				redirect('auth/login');

			}

		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password is failed. Wrong email!</div>');
			redirect('auth/login');

		}
	}

	public function changePassword() 
	{

		if(!$this->session->userdata('reset_email')) {
			redirect('auth/login');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

		if($this->form_validation->run() == false) {
			$data['title'] = 'Change Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/change-password');
			$this->load->view('templates/auth_footer');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed. Please login!</div>');
			redirect('auth/login');
		}

		
	}

	
}
<<<<<<< HEAD
=======

}
>>>>>>> origin/user1
=======
>>>>>>> 89fc6ae3e125c9f85d2f7b4297032c66693c0799
