<?php

class Model_barang extends CI_Model {
	public function tampil_data()
	{
		return $this->db->get('tbl_barang')->result_array();
	}

	public function tambah_barang($data,$table)
	{
		$this->db->insert($table,$data);
	}

	public function detail_barang($id_brg)
	{
		return $this->db->get_where('tbl_barang',['id_barang' => $id_brg])->row_array();
	}
	public function barang_kembali($id)
	{
		$query =	"SELECT `user` .*, `tbl_pinjam` .*, `tbl_barang`.*
					FROM `user` JOIN `tbl_pinjam`
					ON `user`.`id` = `tbl_pinjam`.`id_user` 
					JOIN `tbl_barang`
					ON `tbl_barang`.`id_barang` = `tbl_pinjam`.`id_brg`
					WHERE `tbl_pinjam`.`id_pinjam` = '$id'
		";
		
		return $this->db->query($query)->row_array();	
		
	}
}

	?>
	