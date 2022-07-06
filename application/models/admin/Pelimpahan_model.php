<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelimpahan_model extends CI_Model{

	public function get_all(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->from('ci_pelimpahan');
		}else{
			$this->db->from('ci_pelimpahan');
			$this->db->where('kd_area', $this->session->userdata('kd_area'));
		}
			
			$this->db->order_by('id','asc');
        return $this->db->get()->result_array();
		}

		public function get_all_pkb(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
				$this->db->from('ci_pelimpahan');
				$this->db->where('kd_area', 01);
			}else{
				$this->db->from('ci_pelimpahan');
				$this->db->where('kd_area', $this->session->userdata('kd_area'));
			}
				
				$this->db->order_by('id','asc');
			return $this->db->get()->result_array();
			}

	public function get_all_plainnya(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->from('ci_pengeluaran_lain');
			$this->db->where('kd_area', 01);
		}else{
			$this->db->from('ci_pengeluaran_lain');
			$this->db->where('kd_area', $this->session->userdata('kd_area'));
		}
			
			$this->db->order_by('id','asc');
		return $this->db->get()->result_array();
		}


		public function get_all_tlainnya(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
				$this->db->from('ci_penerimaan_lain');
				$this->db->where('kd_area', 01);
			}else{
				$this->db->from('ci_penerimaan_lain');
				$this->db->where('kd_area', $this->session->userdata('kd_area'));
			}
				
				$this->db->order_by('id','asc');
			return $this->db->get()->result_array();
			}
			
	
	public function get_all_tf_bud(){
			$this->db->from('ci_transfer_bud');
			$this->db->order_by('id','asc');
		return $this->db->get()->result_array();
		}

	function get_rekening_transfer()
		{	
			$id= array('1010301','1010302','1010303','1010304','1010305','1010306','1010307','1010308','1010309','1010310');
			$this->db->from('ci_saldo_awal');
			$this->db->where_in('no_rekening', $id);
			$query=$this->db->get();
			return $query->result_array();
		}	
	
	public function angka($nilai){
		$nilai=str_replace(',','',$nilai);
		return $nilai;
	}


function get_kas_rekening($id)
	{	

		$this->db->select("ifnull(sum(terima), 0)-ifnull(sum(keluar), 0) as total");
		$this->db->from('cetakan_kas_rekening');
		$this->db->where('no_rekening', $id);
		$query=$this->db->get();
		return $query;
	}


	

	

	function get_pegawai_by_area($area)
	{
		// $query = $this->db->get_where('get_pegawai', array('kd_area' => $area));
		
		$id= array('1010301','1010302','1010303','1010304','1010305','1010306','1010307','1010308','1010309','1010310','1010102');
		$this->db->from('get_pegawai');
		$this->db->where('kd_area',$area);
		$this->db->where_not_in('kd_pegawai', $id);
		$query=$this->db->get();
		return $query;
	}
	public function simpan_pelimpahan($data){
		$this->db->insert('ci_pelimpahan', $data);
		return true;
	}

	public function simpan_plainnya($data){
		$this->db->insert('ci_pengeluaran_lain', $data);
		return true;
	}

	public function simpan_tlainnya($data){
		$this->db->insert('ci_penerimaan_lain', $data);
		return true;
	}

	public function simpan_transfer_bud($data){
		$this->db->insert('ci_transfer_bud', $data);
		return true;
	}

	function get_bank()
	{
		$this->db->from('ci_rekening_bank');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_nomor_kb(){
		
		$this->db->from('get_urut_bud');
		return $result = $this->db->get()->row_array();
}

	//-----------------------------------------------------
function get_pelimpahan_by_id($id)
	{
		$this->db->from('ci_pelimpahan');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}
function get_transferbud_by_id($id)
	{
		$this->db->from('ci_transfer_bud');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}
function get_plain_by_id($id)
	{
		$this->db->from('ci_pengeluaran_lain');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	function get_tlain_by_id($id)
	{
		$this->db->from('ci_penerimaan_lain');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	

	function get_akun()
	{	
		$id= array('5010101','5010102','5010103','5010104','5010105','5010106','5010501','5010601','5041501');
		$this->db->from('ci_coa');
		$this->db->where_in('no_acc', $id);
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_akun_terima()
	{	
		$id= array('4010101','4010201','4010301','4010401','4010501','4020101','4020201','4020301','4020401');
		$this->db->from('ci_coa');
		$this->db->where_in('no_acc', $id);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	
	//---------------------------------------------------
	// Edit Admin Record
public function edit_pelimpahan($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_pelimpahan', $data);
	return true;
}

public function edit_plain($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_pengeluaran_lain', $data);
	return true;
}

public function edit_tlain($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_penerimaan_lain', $data);
	return true;
}

public function edit_transfer_bud($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_transfer_bud', $data);
	return true;
}


	//-----------------------------------------------------
function delete($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_pelimpahan');
} 

function delete_transfer($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_transfer_bud');
} 


function delete_plainnya($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_pengeluaran_lain');
} 

function delete_tlainnya($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_penerimaan_lain');
} 

}

?>