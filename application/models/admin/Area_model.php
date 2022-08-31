<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model{

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
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Divisi Finance' || $this->session->userdata('admin_role')=='Admin' ){
			$this->db->from('ci_area');
			$this->db->where('id <>','0');
			$this->db->where('kdgroup','1');	
		}else{
			$userarea = $this->session->userdata('kd_area');
			$this->db->from('ci_area');
			$this->db->where('kd_area',$userarea);	
			$this->db->where('id <>','0');	
			$this->db->where('kdgroup','1');	
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_area_pkb()
	{	
		$id= array('01','11');
		$this->db->from('ci_area');
		$this->db->where_in('kd_area', $id);
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_area_pusat()
	{	
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Divisi Finance' || $this->session->userdata('admin_role')=='Admin'  || $this->session->userdata('admin_role')=='AE' || $this->session->userdata('admin_role')=='Marketing'){
			$this->db->from('ci_area');
			$this->db->where('id <>','0');	
			$this->db->where('kdgroup','1');	
		}else{
			$userarea = $this->session->userdata('kd_area');
			$this->db->from('ci_area');
			$this->db->where('kd_area',$userarea);	
			$this->db->where('id <>','0');	
			$this->db->where('kdgroup','1');	
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_area_pdp()
	{	
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Divisi Finance' || $this->session->userdata('admin_role')=='Admin'  || $this->session->userdata('admin_role')=='Marketing'){
			$this->db->from('ci_area');
			$this->db->where('kd_area <>','all');	
			$this->db->where('kdgroup','1');	
		}else{
			$userarea = $this->session->userdata('kd_area');
			$this->db->from('ci_area');
			$this->db->where('kd_area',$userarea);	
			$this->db->where('id <>','0');
			$this->db->where('kdgroup','1');	
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}
	

	function get_area2()
	{	
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
			$this->db->from('ci_area');
			$this->db->where('kdgroup','1');	
		}else{
			$userarea = $this->session->userdata('kd_area');
			$this->db->from('ci_area');
			$this->db->where('kd_area',$userarea);	
			$this->db->where('kdgroup','1');	
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}

	//-----------------------------------------------------
	function get_admin_by_id($id)
	{
		$this->db->from('ci_users');
		$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id = ci_users.admin_role_id');
		$this->db->where('user_id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	//-----------------------------------------------------
	function get_all()
	{

		$this->db->from('ci_users');

		$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id=ci_users.admin_role_id');

		if($this->session->userdata('filter_type')!='')

			$this->db->where('ci_users.admin_role_id',$this->session->userdata('filter_type'));

		if($this->session->userdata('filter_status')!='')

			$this->db->where('ci_users.is_active',$this->session->userdata('filter_status'));


		$filterData = $this->session->userdata('filter_keyword');

		$this->db->like('ci_admin_roles.admin_role_title',$filterData);
		$this->db->or_like('ci_users.firstname',$filterData);
		$this->db->or_like('ci_users.lastname',$filterData);
		$this->db->or_like('ci_users.email',$filterData);
		$this->db->or_like('ci_users.mobile_no',$filterData);
		$this->db->or_like('ci_users.username',$filterData);

		$this->db->where('ci_users.is_supper !=', 1);

		$this->db->order_by('ci_users.user_id','desc');

		$query = $this->db->get();

		$module = array();

		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}

		return $module;
	}

	//-----------------------------------------------------
public function add_admin($data){
	$this->db->insert('ci_users', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_admin($data, $id){
	$this->db->where('user_id', $id);
	$this->db->update('ci_users', $data);
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
	$this->db->where('user_id',$id);
	$this->db->delete('ci_users');
} 

}

?>