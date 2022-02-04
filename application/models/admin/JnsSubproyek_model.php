<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jnssubproyek_model extends CI_Model{


function get_subproyek($jnproyek){
	$query = $this->db->get_where('ci_subprojek', array('kd_projek' => $jnproyek));
	return $query;
}


	function get_jnsproyek()
	{
		$this->db->from('ci_projek');
		$query=$this->db->get();
		return $query->result_array();
	}

}

?>