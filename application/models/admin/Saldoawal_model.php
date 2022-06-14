<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Saldoawal_model extends CI_Model{

	public function get_all(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->from('ci_saldo_awal');
		}else{
			$this->db->from('ci_saldo_awal');
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
	public function add_saldoawal($data){
		$this->db->insert('ci_saldo_awal', $data);
		return true;
	}

	function get_bank()
	{
		$this->db->from('ci_rekening_bank');
		$query=$this->db->get();
		return $query->result_array();
	}

	//-----------------------------------------------------
	function get_saldo_by_id($id)
	{
		$this->db->select("*, case 
								when left(kd_pegawai,2)='PG' then (select nama from ci_pegawai where kd_pegawai=ci_saldo_awal.kd_pegawai) 
								else 
								(select nm_rekening from ci_rekening_kas where no_rekening=ci_saldo_awal.kd_pegawai LIMIT 1) 
								end as nama");
		$this->db->from('ci_saldo_awal');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	
	//---------------------------------------------------
	// Edit Admin Record
public function edit_saldo($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_saldo_awal', $data);
	return true;
}

	//-----------------------------------------------------
function change_status()
{		
	$this->db->set('is_active',$this->input->post('status'));
	$this->db->where('user_id',$this->input->post('id'));
	$this->db->update('ci_users');
} 

	//-----------------------------------------------------
function delete($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_saldo_awal');
} 

}

?>