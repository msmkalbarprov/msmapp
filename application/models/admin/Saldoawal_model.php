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


	function get_bank()
	{
		$this->db->from('ci_rekening_bank');
		$query=$this->db->get();
		return $query->result_array();
	}

	//-----------------------------------------------------
	function get_saldo_by_id($id)
	{
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
	$this->db->delete('ci_rekening_bank');
} 

}

?>