<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian_model extends CI_Model{

	public function get_all(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin'){
			$this->db->from('ci_pengembalian_pegawai');
		}else{
			$this->db->from('ci_pengembalian_pegawai');
			$this->db->where('kd_area', $this->session->userdata('kd_area'));
		}
			
			$this->db->order_by('id','asc');
        return $this->db->get()->result_array();
		}
	
	public function angka($nilai){
		$nilai=str_replace(',','',$nilai);
		return $nilai;
	}

	function get_pegawai_by_area($area)
	{
		$query = $this->db->get_where('get_pegawai', array('kd_area' => $area));
		return $query;
	}
	public function simpan_pengembalian($data){
		$this->db->insert('ci_pengembalian_pegawai', $data);
		return true;
	}

	function get_bank()
	{
		$this->db->from('ci_rekening_bank');
		$query=$this->db->get();
		return $query->result_array();
	}

    function get_kas($id,$kd_pegawai)
	{	
		$this->db->select("ifnull(nilai,0) as total");
		$this->db->from('get_kas_pegawai');
        $this->db->where('kd_pegawai', $kd_pegawai);	
		$query=$this->db->get();
		return $query;
	}

	//-----------------------------------------------------
	function get_pengembalian_by_id($id)
	{
		$this->db->from('ci_pengembalian_pegawai');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	
	//---------------------------------------------------
	// Edit Admin Record
public function edit_pengembalian($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_pengembalian_pegawai', $data);
	return true;
}


	//-----------------------------------------------------
function delete($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_pengembalian_pegawai');
} 

}

?>