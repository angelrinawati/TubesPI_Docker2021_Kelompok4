<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Dashboard'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['jumlahBarang'] = $this->Model_barang->getJumlahBarang();
		$data['jumlahPermohonan'] = $this->Model_barang->getJumlahPermohonan();
		$data['jumlahPengembalian'] = $this->Model_barang->getJumlahPengembalian();
		$data['jumlahUser'] = $this->Model_barang->getJumlahUser();

		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

    public function role()
	{
		$data['title'] = 'Role'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();
		
		$this->form_validation->set_rules('role', 'Role Name', 'required');
		if ($this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'role' => $this->input->post('role')
			];

			$this->db->insert('user_role', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Role Added!</div>');
			redirect('admin/role');
		}
	}

	public function roleAccess($role_id)
	{
		$data['title'] = 'Role'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');
		
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed</div>');

	}

    public function deleteRole($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_role');
		redirect('admin/role');
	}

    public function barang() 
	{
		$data['title'] = 'Data Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		//$data['barang'] = $this->db->get('tbl_barang')->result_array();

		//pagination
		$this->load->library('pagination');

		//ambil data keyword
		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword' , $data['keyword']);
		} else {
			$data['keyword'] =$this->session->userdata('keyword');
		}

		//config
		$this->db->like('name' , $data['keyword']);
		$this->db->or_like('desc' , $data['keyword']);
		$this->db->from('tbl_barang');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['per_page']=5;
		
		//initialize
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['barang'] = $this->Model_barang->getBarang($config['per_page'],$data['start'], $data['keyword']);

		$this->form_validation->set_rules('name', 'Nama Barang', 'required');
		$this->form_validation->set_rules('desc', 'Deskripsi Barang', 'required');
		$this->form_validation->set_rules('stock', 'Stock Barang', 'required');
		
		if ($this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang', $data);
			$this->load->view('templates/footer');
		} else {
			//Tambah Data
			$name	= $this->input->post('name');
			$desc	= $this->input->post('desc');
			$stock	= $this->input->post('stock');
			$gambar	= $_FILES['gambar']['name'];
			
			if($gambar) 
			{
				$config ['upload_path'] = './assets/img/profile';
				$config ['allowed_types'] = 'jpg|jpeg|png|gif';
				
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('gambar'))
				{
					echo "Gambar Gagal Diupload!";
				}
				
				else
				{
					$gambar = $this->upload->data('file_name');
				}
				
				$data = array(
					'name'		=> $name,
					'desc'		=> $desc,
					'stock'		=> $stock,
					'gambar'	=> $gambar			
				);

				$this->Model_barang->tambah_barang($data, 'tbl_barang');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang ditambah!</div>');
				redirect('admin/barang');
			}
		}
		
	}

	public function editBarang($id_barang)
	{
		$data['title'] = 'Edit Barang'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$where = array('id_barang' => $id_barang);
		$data['barang'] = $this->Model_barang->edit_barang($where, 'tbl_barang')->result();

		$this->form_validation->set_rules('name', 'Nama Barang', 'required|trim');
		$this->form_validation->set_rules('desc', 'Kondisi Barang', 'required|trim');
		$this->form_validation->set_rules('stock', 'Stock Barang', 'required|trim|numeric');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang-edit', $data);
			$this->load->view('templates/footer');
		} else {
			$id_barang 	= $this->input->post('id_barang');
			$name		= $this->input->post('name');
			$desc		= $this->input->post('desc');
			$stock		= $this->input->post('stock');
			$gambar		= $_FILES['gambar']['name'];

			//jika ada upload gambar
			if(!empty($gambar)) 
			{
				$config ['upload_path'] = './assets/img/profile';
				$config ['allowed_types'] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);
				
				if( $this->upload->do_upload('gambar')) 
				{
					$gambar = $this->upload->data("file_name");
				}
			}
			else 
			{
				$gambar = $this->input->post('old_image');
			}

			$data = array(

				'name'		=> $name,
				'desc'		=> $desc,
				'stock'		=> $stock, 
				'gambar'	=> $gambar,
			);

			$where = array(
				'id_barang' => $id_barang
			);

			$this->Model_barang->update_data($where, $data, 'tbl_barang');
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang berhasil diedit!</div>');
			redirect('admin/barang');
		}
		
	}
	
	public function deleteBarang($id_barang)
	{
		$this->db->where('id_barang', $id_barang);
		$this->db->delete('tbl_barang');
		redirect('admin/barang');
	}

	public function permohonan()
	{
		$data['title'] = 'Data Permohonan Peminjaman'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['permohonan'] = $this->Model_barang->getPermohonan();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/permohonan', $data);
		$this->load->view('templates/footer');
	}
	
	public function permohonan_setuju() {
		$email = $this->input->post('email');
		$id_pinjam = $this->input->post('id_pinjam');
		
		$token = base64_encode(random_bytes(32));

		$data = [
			'status' => 1
		];

		$where = [
			'id_pinjam' => $id_pinjam
		];

		$this->db->where($where);
		$this->db->update('tbl_pinjam', $data);

		$this->_sendEmail($token, 'setuju');

		redirect('admin/permohonan');	
	}

	public function permohonan_tolak() {
		$email = $this->input->post('email');
		$id_pinjam = $this->input->post('id_pinjam');

		$token = base64_encode(random_bytes(32));

		$data = [
			'status' => 2
		];

		$where = [
			'id_pinjam' => $id_pinjam
		];

		$this->db->where($where);
		$this->db->update('tbl_pinjam', $data);

		$this->_sendEmail($token, 'tolak');

		redirect('admin/permohonan');	
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
		$this->email->subject('Konfirmasi Peminjaman Barang');

		//data untuk dimasukkan kedalam email
		$full_name = $this->input->post('full_name');
		$name = $this->input->post('name');
		$jumlah = $this->input->post('jumlah');
		$awal_pinjam = $this->input->post('awal_pinjam');
		$akhir_pinjam = $this->input->post('akhir_pinjam');

		$data = array(
			'full_name' => $full_name,
			'name' => $name,
			'jumlah' => $jumlah,
			'awal_pinjam' => $awal_pinjam,
			'akhir_pinjam' => $akhir_pinjam,
			'title' => 'Konfirmasi Peminjaman Barang'
		);

		if($type == 'setuju') {
			$body = $this->load->view('admin/email_setuju', $data, TRUE);
    		$this->email->message($body); 
		} else if($type == 'tolak') {
			$body = $this->load->view('admin/email_tolak', $data, TRUE);
    		$this->email->message($body);
		}
		

		if($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die; 
		}
	}

	public function pengembalian()
	{
		$data['title'] = 'Data Pengembalian Barang'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['permohonan'] = $this->Model_barang->getPengembalian();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/pengembalian', $data);
		$this->load->view('templates/footer');
	}

	public function pengembalian_setuju() {
		$id_pinjam = $this->input->post('id_pinjam');

		$data = [
			'status' => 4
		];

		$where = [
			'id_pinjam' => $id_pinjam
		];

		$this->db->where($where);
		$this->db->update('tbl_pinjam', $data);

		redirect('admin/pengembalian');	
	}

	public function history()
	{
		$data['title'] = 'History'; 
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['history'] = $this->Model_barang->getHistory();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/history', $data);
		$this->load->view('templates/footer');
	}
}