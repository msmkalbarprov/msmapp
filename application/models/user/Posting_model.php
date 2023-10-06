<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posting_model extends CI_Model{
    
    public function posting($data,$tahun,$bulan){
        $this->db->trans_start(TRUE);
            $this->db->query("call rekal_jurnal('".$tahun."','".$bulan."')");
            
            $this->db->update('ci_general_settings', $data);
        $this->db->trans_complete();
        return true;
    }
    
    //-----------------------------------------------------
	function get_last_posting()
	{
		$this->db->from('ci_general_settings');
		$query=$this->db->get();
		return $query->row_array();
	}

}

?>