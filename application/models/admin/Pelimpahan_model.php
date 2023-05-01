<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelimpahan_model extends CI_Model{

	public function get_all(){
		$tahun=$this->session->userdata('tahun');
		$tahun_depan=$tahun+1;
		$tgl_awal = $tahun.'-02-01';
		$tgl_akhir = $tahun_depan.'-02-01';
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
			$this->db->select('ci_pelimpahan.*,(select ifnull(sum(nilai),0) from ci_pelimpahan_potongan where ci_pelimpahan.no_bukti=ci_pelimpahan_potongan.no_kas and ci_pelimpahan_potongan.rek_asal=ci_pelimpahan.kd_pegawai_asal) as potongan');
			$this->db->from('ci_pelimpahan');
			$this->db->where('kd_area <>', 01);
			$this->db->where('tgl_pelimpahan >=', $tgl_awal);
			$this->db->where('tgl_pelimpahan <', $tgl_akhir);
		}else{
			$this->db->select('ci_pelimpahan.*,(select ifnull(sum(nilai),0) from ci_pelimpahan_potongan where ci_pelimpahan.no_bukti=ci_pelimpahan_potongan.no_kas and ci_pelimpahan_potongan.rek_asal=ci_pelimpahan.kd_pegawai_asal) as potongan');
			$this->db->from('ci_pelimpahan');
			$this->db->where('kd_area', $this->session->userdata('kd_area'));
			$this->db->where('kd_area <>', 01);
			$this->db->where('tgl_pelimpahan >=', $tgl_awal);
			$this->db->where('tgl_pelimpahan <', $tgl_akhir);
		}
			
			$this->db->order_by('id','asc');
        return $this->db->get()->result_array();
		}

		public function get_all_tunai(){
			$tahun=$this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal = $tahun.'-02-01';
			$tgl_akhir = $tahun_depan.'-02-01';

			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
				$this->db->from('ci_ambil_tunai');
			}else{
				$this->db->from('ci_ambil_tunai');
				$this->db->where('kd_area', $this->session->userdata('kd_area'));
			}
				$this->db->where('tgl_kas >=', $tgl_awal);
				$this->db->where('tgl_kas <', $tgl_akhir);
				$this->db->order_by('id','asc');
				return $this->db->get()->result_array();
			}

		public function get_all_pkb(){
			$tahun=$this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal = $tahun.'-02-01';
			$tgl_akhir = $tahun_depan.'-02-01';

			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
				$this->db->from('ci_pelimpahan');
				$this->db->where('kd_area', 01);
			}else{
				$this->db->from('ci_pelimpahan');
				$this->db->where('kd_area', $this->session->userdata('kd_area'));
			}
			$this->db->where('tgl_pelimpahan >=', $tgl_awal);
			$this->db->where('tgl_pelimpahan <', $tgl_akhir);
				$this->db->order_by('id','asc');
			return $this->db->get()->result_array();
			}

	public function get_all_plainnya(){
		$tahun=$this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal = $tahun.'-02-01';
			$tgl_akhir = $tahun_depan.'-02-01';
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
			$this->db->select('ci_pengeluaran_lain.*,(select ifnull(sum(nilai),0) from ci_pengeluaran_lain_potongan where no_kas=ci_pengeluaran_lain.no_bukti)as potongan');
			$this->db->from('ci_pengeluaran_lain');
		}else{
			$this->db->select('ci_pengeluaran_lain.*,(select ifnull(sum(nilai),0) from ci_pengeluaran_lain_potongan where no_kas=ci_pengeluaran_lain.no_bukti)as potongan');
			$this->db->from('ci_pengeluaran_lain');
		}
		$this->db->where('tgl_bukti >=', $tgl_awal);
		$this->db->where('tgl_bukti <', $tgl_akhir);
			$this->db->order_by('id','asc');
		return $this->db->get()->result_array();
		}


		public function get_all_tlainnya(){
			$tahun=$this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal = $tahun.'-02-01';
			$tgl_akhir = $tahun_depan.'-02-01';

			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
				$this->db->from('ci_penerimaan_lain');
				$this->db->where('kd_area', 01);
			}else{
				$this->db->from('ci_penerimaan_lain');
				$this->db->where('kd_area', $this->session->userdata('kd_area'));
			}
				$this->db->where('tgl_bukti >=', $tgl_awal);
				$this->db->where('tgl_bukti <', $tgl_akhir);
				$this->db->order_by('id','asc');
			return $this->db->get()->result_array();
			}
			
	
	public function get_all_tf_bud(){
			$tahun=$this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal = $tahun.'-02-01';
			$tgl_akhir = $tahun_depan.'-02-01';

			$this->db->select('ci_transfer_bud.*, (select ifnull(sum(nilai),0) from ci_transfer_bud_potongan where no_kas=ci_transfer_bud.no_bukti)as potongan');
			$this->db->from('ci_transfer_bud');
			$this->db->where('tgl_transfer >=', $tgl_awal);
			$this->db->where('tgl_transfer <', $tgl_akhir);
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
	$this->db->from("ci_pengeluaran_lain_potongan");
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
	$this->db->insert('ci_pengeluaran_lain_potongan', $data);
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
		$this->db->from('ci_pengeluaran_lain');
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

	function get_akun_pengeluaran($area,$divisi)
	{
		if ($divisi=='3' && ($area=='DD00' || $area=='DD02' || $area=='DD04' || $area=='DD05' || $area=='DD07' || $area=='DD08' || $area=='DD15' || $area=='DD17' || $area=='DD19' || $area=='BB02' || $area=='EE01' || $area=='FF01' || $area=='FF02')){
			$id= array('5010101','5010102','5010103','5010104','5010105','5010106','5010501','5010601','5041501','1010101','1010106','1010301','1010302','1010306','1010307','1011301','1020302','1020506','1020902','2010405','2010801','2010802','2010801','2010802','2010804','2020201','5010201','5010202','5020101','5020501','5030101','5030109','5030111','5040101','5040102','5040104','5040105','5040106','5040201','5040202','5040203','5040204','5040205','5040206','5040301','5040601','5040602','5040701','5040702','5040704','5040801','5040802','5040804','5040805','5040901','5040902','5041001','5041002','5041101','5041202','5041401','5041404','5041406','5041501','5041504','5041601','5030112','5040103','1010327');
			$where1 = 'no_acc';
			$this->db->where_in($where1, $id);
			$this->db->from('ci_coa');
			$query=$this->db->get();
		}else if ($area=='00' || $area=='01'){
			$this->db->from('ci_coa');
			$this->db->where('level',4);
			$this->db->order_by('no_acc');
			$query=$this->db->get();

		}else{
			$this->db->select('kd_item');
			$this->db->from('ci_pq_operasional');
			$this->db->where_in('kd_area', $area);
			$query 			=	$this->db->get();
			$query1_result 	= 	$query->result();
			$id= array();
			foreach($query1_result as $row){
				$id[] = $row->kd_item;
			}
			$ids = implode(",",$id);
			$id = explode(",", $ids);
			$where1 = 'left(no_acc,5)';
			$this->db->where_in($where1, $id);
			$this->db->from('ci_coa');
		
			$query=$this->db->get();
	}
		
		return $query;
	}

	function get_area_pengeluaran($divisi)
	{
		if ($divisi=='3'){
			$this->db->where('kdgroup', 2);
		}else{
			$this->db->where('kdgroup', 1);
		}

		$this->db->from('ci_area');
		
		$query=$this->db->get();
		return $query;
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
		$id= array('4010101','4010201','4010301','4010401','4010501','4020101','4020201','4020301','4020401','2010405','6010201','6010401','2010602','1011301','2020201','1010327','1010328');
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
	$this->db->delete('ci_pengeluaran_lain');
} 

function delete_tlainnya($id)
{		
	$this->db->where('id',$id);
	$this->db->delete('ci_penerimaan_lain');
} 

}

?>