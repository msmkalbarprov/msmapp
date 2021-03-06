<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_model extends CI_Model{

	public function get_all(){
			$this->db->from('ci_perusahaan');
			$this->db->order_by('id','asc');
        return $this->db->get()->result_array();
		}
	//--------------------------------------------------------------------
	public function update_user($data){
		$id = $this->session->userdata('user_id');
		$this->db->where('user_id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function change_pwd($data, $id){
		$this->db->where('user_id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}
	//-----------------------------------------------------
	function get_admin_roles()
	{
		$this->db->from('ci_admin_roles');
		$this->db->where('admin_role_status',1);
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_perusahaan()
	{
		$this->db->from('ci_perusahaan');
		$query=$this->db->get();
		return $query->result_array();
	}

	//-----------------------------------------------------
	function get_perusahaan_by_id($id)
	{
		$this->db->from('ci_perusahaan');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	//-----------------------------------------------------
	

	//-----------------------------------------------------
public function add_perusahaan($data){
	$this->db->insert('ci_perusahaan', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_perusahaan($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_perusahaan', $data);
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
	$this->db->delete('ci_perusahaan');
} 

}

?>