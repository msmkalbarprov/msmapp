<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model{

	public function get_all(){
			$this->db->from('ci_rekening_bank');
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
	function get_bank_by_id($id)
	{
		$this->db->from('ci_rekening_bank');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	//-----------------------------------------------------
	

	//-----------------------------------------------------
public function add_bank($data){
	$this->db->insert('ci_rekening_bank', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_bank($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_rekening_bank', $data);
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