<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_model_area extends CI_Model{


    public function get_all_plainnya_area(){
		$tahun=$this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal = $tahun.'-02-01';
			$tgl_akhir = $tahun_depan.'-02-01';

		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
			$this->db->from('ci_pengeluaran_lain_area');
		}else{
			$this->db->from('ci_pengeluaran_lain_area');
            $this->db->where('kd_area', $this->session->userdata('kd_area'));
		}
			$this->db->where('tgl_bukti >=', $tgl_awal);
			$this->db->where('tgl_bukti <', $tgl_akhir);
			$this->db->order_by('id','asc');
		return $this->db->get()->result_array();
		}

        function get_akun_pengeluaran($area,$divisi)
        {
                $this->db->from('ci_coa_lainnya');
                $this->db->where('jenis', 2);
                $query=$this->db->get();
            
            return $query;
        }

        function get_area_pengeluaran($divisi)
	{
        if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' || $this->session->userdata('admin_role')=='Difisi Finance'  ){
            $this->db->where('kdgroup', 1);
        }else{
            $this->db->where('kd_area', $this->session->userdata('kd_area'));
            $this->db->where('kdgroup', 1);
        }
		$this->db->from('ci_area');
		
        
		$query=$this->db->get();
		return $query;
	}


	public function get_all(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' || $this->session->userdata('admin_role')=='Difisi Finance'  ){
			$this->db->select('ci_pelimpahan.*,(select ifnull(sum(nilai),0) from ci_pelimpahan_potongan where ci_pelimpahan.no_bukti=ci_pelimpahan_potongan.no_kas and ci_pelimpahan_potongan.rek_asal=ci_pelimpahan.kd_pegawai_asal) as potongan');
			$this->db->from('ci_pelimpahan');
			$this->db->where('kd_area <>', 01);
		}else{
			$this->db->select('ci_pelimpahan.*,(select ifnull(sum(nilai),0) from ci_pelimpahan_potongan where ci_pelimpahan.no_bukti=ci_pelimpahan_potongan.no_kas and ci_pelimpahan_potongan.rek_asal=ci_pelimpahan.kd_pegawai_asal) as potongan');
			$this->db->from('ci_pelimpahan');
			$this->db->where('kd_area', $this->session->userdata('kd_area'));
			$this->db->where('kd_area <>', 01);
		}
			
			$this->db->order_by('id','asc');
        return $this->db->get()->result_array();
		}

		public function get_all_tunai(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
				$this->db->from('ci_ambil_tunai');
			}else{
				$this->db->from('ci_ambil_tunai');
				$this->db->where('kd_area', $this->session->userdata('kd_area'));
			}
				$this->db->order_by('id','asc');
				return $this->db->get()->result_array();
			}

		public function get_all_pkb(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
				$this->db->from('ci_pelimpahan');
				$this->db->where('kd_area', 01);
			}else{
				$this->db->from('ci_pelimpahan');
				$this->db->where('kd_area', $this->session->userdata('kd_area'));
			}
				
				$this->db->order_by('id','asc');
			return $this->db->get()->result_array();
			}

	


		public function get_all_tlainnya(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
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
			$this->db->select('ci_transfer_bud.*, (select ifnull(sum(nilai),0) from ci_transfer_bud_potongan where no_kas=ci_transfer_bud.no_bukti)as potongan');
			$this->db->from('ci_transfer_bud');
			$this->db->order_by('id','asc');
		return $this->db->get()->result_array();
		}

	function get_rekening_transfer()
		{	
			$id= array('1010301','1010302','1010303','1010304','1010305','1010306','1010307','1010308','1010309','1010310','1010102');
			$this->db->from('ci_saldo_awal');
			$this->db->where_in('no_rekening', $id);
			$query=$this->db->get();
			return $query->result_array();
		}
        
        function get_rekening_kas()
        {	
            $rekening = array('1010105');
                $this->db->select('no_acc as kode, nm_acc as nama');
                $this->db->from('ci_coa');
                $this->db->where_in('no_acc',$rekening);
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


public function get_potongan_transfer_by_id($id){
		$this->db->from("ci_transfer_bud_potongan");
		$this->db->where('no_kas',$id);
		return $this->db->get()->result_array();
}

public function get_potongan_plain_by_id($id){
	$this->db->from("ci_pengeluaran_lain_area_potongan");
	$this->db->where('no_kas',$id);
	return $this->db->get()->result_array();
}

public function get_potongan_pkb_by_id($id){
	$this->db->from("ci_pelimpahan_potongan");
	$this->db->where('no_kas',$id);
	$this->db->where('rek_asal',null);
	return $this->db->get()->result_array();
}


public function get_potongan_pelimpahan_by_id($id){
	$this->db->from("ci_pelimpahan_potongan");
	$this->db->where('no_kas',$id);
	$this->db->where('rek_asal <>',null);
	return $this->db->get()->result_array();
}

public function simpan_potongan($data){
	$this->db->insert('ci_transfer_bud_potongan', $data);
	return true;
}

public function simpan_potongan_plain($data){
	$this->db->insert('ci_pengeluaran_lain_area_potongan', $data);
	return true;
}

public function simpan_potongan_pkb($data){
	$this->db->insert('ci_pelimpahan_potongan', $data);
	return true;
}

public function simpan_potongan_pelimpahan($data){
	// $this->db->insert('ci_pelimpahan_potongan', $data);

	$rekasal = $data['rek_asal'];
	$query="SELECT nomor from get_urut_spj_pegawai where kd_pegawai='$rekasal'";
	$hasil = $this->db->query($query);
	$nomor = $hasil->row('nomor');

	$insert_data['no_bukti'] 			= $nomor;
	$insert_data['no_kas'] 				= $data['no_kas'];
	$insert_data['rek_asal']			= $data['rek_asal'];
	$insert_data['no_acc'] 				= $data['no_acc'];
	$insert_data['uraian']				= $data['uraian'];
	$insert_data['nilai'] 				= $data['nilai'];
	$insert_data['username']			= $this->session->userdata('username');
	$insert_data['created_at']			= date("Y-m-d h:i:s");
	$this->db->insert('ci_pelimpahan_potongan', $insert_data);

	if (substr($rekasal,0,2)=='PG'){
		$this->db->where('kd_pegawai', $rekasal);
		$this->db->set('no_spj', $nomor);
		$this->db->update('ci_pegawai');
	}
	


	return true;

	
	
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

	function get_pegawai_tunai_by_area($area)
	{
		$this->db->from('get_pegawai');
		$this->db->where('kd_area',$area);
		$this->db->where('pemegang_kas',1);
		$query=$this->db->get();
		return $query;
	}


	public function simpan_pelimpahan($data){
		$this->db->insert('ci_pelimpahan', $data);
		return true;
	}

	public function simpan_ambil_tunai($data){
		$this->db->insert('ci_ambil_tunai', $data);
		return true;
	}

	public function simpan_plainnya($data){
		$this->db->insert('ci_pengeluaran_lain_area', $data);
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

function get_kas_tunai_by_id($id)
	{
		$this->db->from('ci_ambil_tunai');
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
	function get_transferbud_potongan_by_id($id)
	{
		$this->db->from('ci_transfer_bud');
		$this->db->where('no_bukti',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

function get_plain_potongan_by_id($id)
	{
		$this->db->from('ci_pengeluaran_lain_area');
		$this->db->where('no_bukti',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

function get_pelimpahan_potongan_by_id($id,$kd_pegawai)
	{
		$this->db->from('ci_pelimpahan');
		$this->db->where('no_bukti',$id);
		$this->db->where('kd_pegawai_asal',$kd_pegawai);
		$query=$this->db->get();
		return $query->row_array();
	}

	function get_pkb_potongan_by_id($id)
	{
		$this->db->from('ci_pelimpahan');
		$this->db->where('no_bukti',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

function get_plain_by_id($id)
	{
		$this->db->from('ci_pengeluaran_lain_area');
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
		$id= array('4010101','4010201','4010301','4010401','4010501','4020101','4020201','4020301','4020401','2010405','6010201','6010401','2010602');
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

public function edit_ambil_tunai($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_ambil_tunai', $data);
	return true;
}

public function edit_plain($data, $id){
	$this->db->where('id', $id);
	$this->db->update('ci_pengeluaran_lain_area', $data);
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


function delete_ambil_tunai($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_ambil_tunai');
} 

function delete_transfer($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_transfer_bud');
} 


function delete_plainnya($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_pengeluaran_lain_area');
} 

function delete_tlainnya($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_penerimaan_lain');
} 

}

?>