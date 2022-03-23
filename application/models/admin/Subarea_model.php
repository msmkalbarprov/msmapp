<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subarea_model extends CI_Model{


	var $table = 'ci_subarea';
    var $column_order = array('nm_area','nm_subarea',null); //set column field database for datatable orderable
    var $column_search = array('nm_area','nm_subarea','address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('kd_area' => 'desc'); // default order 


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

	function get_subarea()
	{
		$userarea = $this->session->userdata('kd_area');
		$this->db->from('ci_subarea');
		$this->db->where('kd_area',$userarea);
		$query=$this->db->get();
		return $query->result_array();
	}


	function get_subarea_by_area($area)
	{
		$query = $this->db->get_where('ci_subarea', array('kd_area' => $area));
		return $query;
	}

	function get_kabupaten()
	{
		$this->db->from('ci_kabupaten');
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

function get_subarea_by_id($id)
	{
		$this->db->from('ci_subarea');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	

	//-----------------------------------------------------
public function get_all(){

	if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
		$this->db->select('ci_subarea.*,ci_area.nm_area');
			$this->db->from('ci_subarea');
			$this->db->join('ci_area','ci_subarea.kd_area=ci_area.kd_area', 'left');
			$this->db->order_by('kd_area','asc');
	}else{
			$this->db->select('ci_subarea.*,ci_area.nm_area');
			$this->db->from('ci_subarea');
			$this->db->join('ci_area','ci_subarea.kd_area=ci_area.kd_area', 'left');
			$this->db->where('ci_subarea.kd_area', $this->session->userdata('kd_area'));

			$this->db->order_by('kd_area','asc');
	}
			
        return $this->db->get()->result_array();
}

 public function count_all()
    {
        if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
        	$this->db->from('ci_subarea');
        }else{
        	$this->db->from('ci_subarea');
        	$this->db->where('ci_subarea.kd_area', $this->session->userdata('kd_area'));
        }
        return $this->db->count_all_results();
    }

private function _get_datatables_query()
    {
         
        $this->db->from('ci_subarea');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


	//-----------------------------------------------------
public function add_admin($data){
	$this->db->insert('ci_users', $data);
	return true;
}

public function add_subarea($data){
	$this->db->insert('ci_subarea', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_admin($data, $id){
	$this->db->where('user_id', $id);
	$this->db->update('ci_users', $data);
	return true;
}

public function edit_subarea($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_subarea', $data);
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
	$this->db->delete('ci_subarea');
} 

}

?>