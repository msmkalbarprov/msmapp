<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dinas_model extends CI_Model{

	public function get_user_detail(){
		$id = $this->session->userdata('user_id');
		$query = $this->db->get_where('ci_users', array('user_id' => $id));
		return $result = $query->row_array();
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

	function get_area()
	{
		$this->db->from('ci_area');
		$query=$this->db->get();
		return $query->result_array();
	}

	


	//-----------------------------------------------------
	function get_dinas_by_id($id)
	{
		$this->db->from('ci_dinas');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	//-----------------------------------------------------
public function get_all(){
			$this->db->select('ci_dinas.*,ci_subarea.nm_subarea');
			$this->db->from('ci_dinas');
			$this->db->join('ci_subarea','ci_subarea.kd_subarea=ci_dinas.kd_sub_area', 'left');
			$this->db->where('ci_dinas.kd_area', $this->session->userdata('kd_area'));

			$this->db->order_by('id','asc');
        return $this->db->get()->result_array();
		}

	//-----------------------------------------------------
public function add_dinas($data){
	$this->db->insert('ci_dinas', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_dinas($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_dinas', $data);
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
	$this->db->delete('ci_dinas');
} 

}

?>