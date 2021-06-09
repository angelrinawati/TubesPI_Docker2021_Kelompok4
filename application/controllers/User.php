<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	
	public function index()
	{
		$data['title'] = 'My Profile'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit() 
	{
		$data['title'] = 'Edit Profile'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			//cek jika ada gambar yang akan diupload
			$upload_image = $_FILES['image']['name'];

			if($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}


					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated</div>');
			redirect('user');
		}			
	}

	public function changePassword()
	{
		$data['title'] = 'Change Password'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Repeat Password', 'required|trim|min_length[3]|matches[new_password1]');


		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			
			if(!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
				redirect('user/changepassword');
			} else {
				//password baru sama dengan pass lama
				if($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as current password!</div>');
					redirect('user/changepassword');
				} else {
					//pass sudah ok
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
					redirect('user/changepassword');

				}
			}
		}	
		
	}

	public function dataBarang()
	{
		$data['title'] = 'Data Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang'] = $this->Model_barang->tampil_data();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/databarang', $data); //$data utk menerima input nama user di topbar index
		$this->load->view('templates/footer');
	}


	public function detail($id_brg)
	{
		$data['title'] = 'Detail Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang'] = $this->Model_barang->detail_barang($id_brg);
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/detailbarang', $data); //$data utk menerima input nama user di topbar index
		$this->load->view('templates/footer');
	}

	public function pinjam($id_brg)
	{
		$data['title'] = 'Form Peminjaman Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang'] = $this->Model_barang->detail_barang($id_brg);

		$this->form_validation->set_rules('nama', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('job', 'Job', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('awal', 'Tanggal Peminjaman', 'required|trim');
		$this->form_validation->set_rules('kembali', 'Tanggal Pegembalian', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'Number of Borrow', 'required|numeric|greater_than[0]|trim|less_than_equal_to['.$this->input->post('stock').']');
		$this->form_validation->set_rules('tujuan', 'Purpose of Borrowers', 'required|trim');

		if($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/pinjambarang', $data); //$data utk menerima input nama user di topbar index
			$this->load->view('templates/footer');
		} 
		else 
		{
			//$this->Model_barang->tambahPinjam($id);
			$id_user = $this->db->get_where('user', ['id' => $this->session->userdata('email')]);
			//$id_barang = $this->db->get_where('tbl_barang',['id_barang' => $id_brg]);
			$data = [
				'id_brg' => $this->input->post('id_brg'),
				'id_user' => $this->input->post('id_user'),
				'full_name' => htmlspecialchars($this->input->post('nama',true)),
				'job' => htmlspecialchars($this->input->post('job',true)),
				'address' => htmlspecialchars($this->input->post('address',true)),
				'jumlah' => htmlspecialchars($this->input->post('jumlah',true)),
				'awal_pinjam' => htmlspecialchars($this->input->post('awal',true)),
				'akhir_pinjam' => htmlspecialchars($this->input->post('kembali',true)),
				'tujuan' => htmlspecialchars($this->input->post('tujuan',true)),
				'status' => 0
			];
			$this->db->insert('tbl_pinjam',$data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan Peminjaman sedang diproses! Periksa email anda secara berkala</div>');
			redirect('user/databarang');

		}	
	}

	public function historypeminjaman()
	{
		$data['title'] = 'History';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['barang'] = $this->Model_barang->tampil_history();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/history', $data); //$data utk menerima input nama user di topbar index
		$this->load->view('templates/footer');
	}

	public function kembalikan($id)
	{
		$data['title'] = 'Pengembalian Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang'] = $this->Model_barang->barang_kembali($id);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/kembalikan', $data); //$data utk menerima input nama user di topbar index
		$this->load->view('templates/footer');
	}

	public function serahkan($id_pinjam)
	{
		$data = [
			'status' => 3
		];

		$where = [
			'id_pinjam' => $id_pinjam
		];

		$this->db->where($where);
		$this->db->update('tbl_pinjam', $data);

		redirect('user/historypeminjaman');
	}
}