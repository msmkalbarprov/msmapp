<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi_model extends CI_Model{

	public function get_all(){
			$this->db->from('ci_subprojek');
			$this->db->order_by('kd_subprojek','asc');
        return $this->db->get()->result_array();
		}
	
	function get_aplikasi()
	{
		$this->db->from('ci_subprojek');
		$query=$this->db->get();
		return $query->result_array();
	}

	//-----------------------------------------------------
	function get_aplikasi_by_id($id)
	{
		$this->db->from('ci_subprojek');
		$this->db->where('kd_subprojek',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	function get_proyek()
	{	
		$this->db->from('ci_projek');
		$query=$this->db->get();
		return $query->result_array();
	}

	//-----------------------------------------------------
	

	//-----------------------------------------------------
public function add_aplikasi($data){
	$this->db->insert('ci_subprojek', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_aplikasi($data, $id){
	$this->db->where('kd_subprojek', $id);
	$this->db->update('ci_subprojek', $data);
	return true;
}


	//-----------------------------------------------------
function delete($id)
{		
	$this->db->where('kd_subprojek',$id);
	$this->db->delete('ci_subprojek');
} 

}

?>